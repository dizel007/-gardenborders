<?php

require_once "secret_info.php";
$ozon_link = 'https://payapi.ozon.ru/v1/createOrder';


$expiresAt = '2025-12-31T23:59:59Z'; // Дата окончания оплаты
$extId = 'MyOrderID700072'; // Уникальный номер оплаты
$amount = ['currencyCode' => '643', 'value' => '100'];

$fingerprint = sprintf("%s%s%s%s%s%s%s%s", $accessKey, $expiresAt, $extId, $fiscalizationType, $paymentAlgorithm, $amount['currencyCode'], $amount['value'], $secretKey);
$requestSign = hash('sha256', $fingerprint);

// Адреса перехода при удачно и неудачной оплате
$successUrl = "https://gardenborders.ru/pay/order/?extId=".$extId;
$failUrl = "https://gardenborders.ru/pay/no_order/?extId=".$extId;

// данные товаров

$array_items[] = array ( 
      
        "extId"=> "82400-v" ,
        "name"=> "СадоБОрт5555",
        "price"=> $amount,
        "quantity"=> 1,
        "type"=> "TYPE_PRODUCT",
        "unitType"=> "UNIT_PIECE",
        "vat"=> "VAT_NONE"
      );




$send_data = array (
"accessKey"=> $accessKey,
"amount"=> $amount,
"enableFiscalization"=> false,
"expiresAt"=> $expiresAt,
"extId"=> $extId ,
"failUrl"=> $failUrl,
// "fiscalizationPhone"=> "79122020299",
"fiscalizationType"=> $fiscalizationType,
"items"=> array ( 
      array(
        "extId"=> "82400-v" ,
        "name"=> "СадоБОрт5555",
        "price"=> $amount,
        "quantity"=> 1,
        "type"=> "TYPE_PRODUCT",
        "unitType"=> "UNIT_PIECE",
        "vat"=> "VAT_NONE"
    )),
"mode"=> "MODE_FULL",
"paymentAlgorithm"=> $paymentAlgorithm,
"receiptEmail" =>"dizel007@yandex.ru",
"requestSign" => $requestSign,
"successUrl"=> $successUrl

);
$send_json = json_encode($send_data);

echo "<pre>";
print_r($send_data);



die();
$send_json = json_encode($send_data);
echo "<pre>";
print_r($send_json);

$gg = post_with_data_ozon_finance($send_json, $ozon_link) ;


print_r($gg);


/* **************************************************************************************************************
*********  Функция обновляния данных Она ОЗОН
************************************************************************************************************** */

function post_with_data_ozon_finance($send_data, $ozon_link) {

	$ch = curl_init($ozon_link);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		// 'Api-Key:' . '22e9094e-f69b-49d5-9365-a674c2dffc3b',
		// 'Client-Id:' . $client_id_ozon, 
		'Content-Type:application/json'
	));
	curl_setopt($ch, CURLOPT_POSTFIELDS, $send_data); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_HEADER, false);
	$res = curl_exec($ch);

    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE); // Получаем HTTP-код

	// curl_close($ch);
	
	$res = json_decode($res, true);

    if (intdiv($http_code,100) > 2) {
        echo     '<br>Результат обмена озон (с данными POST): '.$http_code. "<br>";
		echo "<pre>";
        print_r($res);
        }

    return($res);	
    }

    