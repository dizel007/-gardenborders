<?php
class SMS {
    public function sendCode($phone, $code) {
        // В тестовом режиме просто логируем
        if (SMS_TEST_MODE) {
            error_log("SMS код для $phone: $code");
            return $this->simulateSMS($phone, $code);
        }
        
        // Реальная отправка через SMS.RU
        return $this->sendViaSMSRU($phone, $code);
    }
    
    private function simulateSMS($phone, $code) {
        // Симуляция отправки SMS
        $_SESSION['sms_code'] = $code;
        return [
            'success' => true,
            'message' => 'Код отправлен (тестовый режим)',
            'code' => $code // Только для тестирования!
        ];
    }
    
    private function sendViaSMSRU($phone, $code) {
        $apiKey = SMS_API_KEY;
        $sender = SMS_SENDER;
        $text = "Ваш код подтверждения: $code";
        
        $url = "https://sms.ru/sms/send";
        $data = [
            'api_id' => $apiKey,
            'to' => $phone,
            'msg' => $text,
            'json' => 1,
            'from' => $sender
        ];
        
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HEADER, false);
        
        $response = curl_exec($ch);
        // curl_close($ch);
        
        $result = json_decode($response, true);
        
        return [
            'success' => isset($result['status']) && $result['status'] == 'OK',
            'message' => isset($result['status_text']) ? $result['status_text'] : 'Ошибка отправки',
            'sms_id' => isset($result['sms'][$phone]['sms_id']) ? $result['sms'][$phone]['sms_id'] : null
        ];
    }
    
    public function validatePhone($phone) {
        // Очищаем номер
        $phone = preg_replace('/[^\d+]/', '', $phone);
        
        // Российские номера
        if (preg_match('/^(\+7|8)/', $phone)) {
            $phone = preg_replace('/^(\+7|8)/', '+7', $phone);
            return strlen($phone) == 12 ? $phone : false;
        }
        
        return false;
    }
}
?>