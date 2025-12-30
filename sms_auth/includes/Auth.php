<?php
class Auth {
    private $db;
    
    public function __construct($db) {
        $this->db = $db;
    }
    
    public function generateCode() {
        return str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
    }
    
    public function sendSMSCode($phone) {
        // Проверяем частоту запросов
        if (!$this->checkRateLimit($phone)) {
            return ['success' => false, 'message' => 'Слишком много запросов. Попробуйте позже.'];
        }
        
        // Генерируем код
        $code = $this->generateCode();
        $expires = date('Y-m-d H:i:s', time() + CODE_LIFETIME);
        
        // Сохраняем в базу
        $this->db->query(
            "INSERT INTO sms_codes (phone, code, expires_at, attempts) 
             VALUES (?, ?, ?, 0)
             ON DUPLICATE KEY UPDATE 
                code = VALUES(code), 
                expires_at = VALUES(expires_at),
                attempts = 0,
                created_at = NOW()",
            [$phone, $code, $expires]
        );
        
        // Отправляем SMS
        $sms = new SMS();
        $result = $sms->sendCode($phone, $code);
        
        if ($result['success']) {
            // Сохраняем номер в сессии
            $_SESSION['login_phone'] = $phone;
            return ['success' => true, 'message' => 'Код отправлен'];
        }
        
        return ['success' => false, 'message' => 'Ошибка отправки SMS'];
    }
    
    public function verifyCode($phone, $code) {
        // Получаем код из базы
        $stmt = $this->db->query("SELECT * FROM sms_codes WHERE phone = ? AND code = ?", [$phone, $code]);
        $data = $stmt->fetch();
       
      // Проверяем количество попыток
        $stmt = $this->db->query("SELECT * FROM sms_codes WHERE phone = ?", [$phone]);
        $data_max_attempts = $stmt->fetch();
        if ($data_max_attempts['attempts'] >= MAX_ATTEMPTS) {
            return ['success' => false, 'die_stop' => true, 'message' => 'Превышено количество попыток'];
        }
        
        if (!$data) {
            // Увеличиваем счетчик попыток
            $this->db->query("UPDATE sms_codes SET attempts = attempts + 1 WHERE phone = ?",[$phone]);
            return ['success' => false, 'message' => 'Неверный код'];
        }
        
        // Проверяем срок действия
        if (strtotime($data['expires_at']) < time()) {
            return ['success' => false, 'message' => 'Срок действия кода истек'];
        }
        

        
        // Код верный - удаляем его
        $this->db->query("DELETE FROM sms_codes WHERE phone = ?", [$phone]);
        
        // Создаем сессию пользователя
        $_SESSION['user_authenticated'] = true;
        $_SESSION['user_phone'] = $phone;
        $_SESSION['login_time'] = time();
        
        return ['success' => true, 'message' => 'Вход выполнен успешно'];
    }
    
    public function isAuthenticated() {
        return isset($_SESSION['user_authenticated']) && $_SESSION['user_authenticated'] === true;
    }
    
    public function requireAuth() {
        if (!$this->isAuthenticated()) {
            header('Location: index.php');
            exit;
        }
    }
    
    public function logout() {
        session_destroy();
        header('Location: index.php');
        exit;
    }
    
    private function checkRateLimit($phone) {
        $stmt = $this->db->query(
            "SELECT COUNT(*) as count FROM sms_codes 
             WHERE phone = ? AND created_at > DATE_SUB(NOW(), INTERVAL 1 HOUR)",
            [$phone]
        );
        
        $result = $stmt->fetch();
        return $result['count'] < 5; // Не более 5 запросов в час
    }
}
?>