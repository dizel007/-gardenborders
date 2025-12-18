<?php

 $ozon_link = "https://payapi.ozon.ru/v1/createPayment";
// $ozon_link = 'https://payapi.ozon.ru/v1/createOrder';
echo "ffffff";

$send_data = '{
  "extId": "MyOrderID-222",
  "payType": "SBP",
  "amount": {
    "currencyCode": "643",
    "value": "130"
  },
  "order": {
    "extId": "MyOrderID-222",
    "amount": {
      "currencyCode": "643",
      "value": "1500"
    },
    "paymentAlgorithm": "PAY_ALGO_SMS",
    "enableFiscalization": true,
    "fiscalizationType": "FISCAL_TYPE_SINGLE",
    "items": [
      {
        "extId": "82401-x",
        "name": "CYRMASKED DDDDDDDDDDDDDDDDDDDDD CYRMASKED CYRMASKED",
        "quantity": 1,
        "unitType": "UNIT_PIECE",
        "type": "TYPE_PRODUCT",
        "vat": "VAT_NONE",
        "price": {
          "currencyCode": "643",
          "value": "1500"
        }
      }
    ],
    "expiresAt": "2025-12-13T15:20:00Z",
    "mode": "MODE_FULL",
    "failUrl": "https://gardenborders.ru/",
    "successUrl": "https://gardenborders.ru/"
  },
  "redirectUrl": "https://gardenborders.ru/",
  "accessKey": "22e9094e-f69b-49d5-9365-a674c2dffc3b"
}';

$gg = post_with_data_ozon_finance('22e9094e-f69b-49d5-9365-a674c2dffc3b', 'dddd', $send_data, $ozon_link ) ;

echo "<pre>";
print_r($gg);


/* **************************************************************************************************************
*********  Функция обновляния данных Она ОЗОН
************************************************************************************************************** */

function post_with_data_ozon_finance($token_ozon, $client_id_ozon, $send_data, $ozon_link ) {

	$ch = curl_init($ozon_link);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		// 'Api-Key:' . $token_ozon,
		// 'Client-Id:' . $client_id_ozon, 
		'Content-Type:application/json'
	));
	curl_setopt($ch, CURLOPT_POSTFIELDS, $send_data); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_HEADER, false);
	$res = curl_exec($ch);

    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE); // Получаем HTTP-код

	curl_close($ch);
	
	$res = json_decode($res, true);

    if (intdiv($http_code,100) > 2) {
        echo     '<br>Результат обмена озон (с данными POST): '.$http_code. "<br>";
		echo "<pre>";
        print_r($res);
        }

    return($res);	
    }

    