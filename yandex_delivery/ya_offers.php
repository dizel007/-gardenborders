<?php
// Получите варианты доставки.
// require_once "yandex_api_functions.php";

// https://dostavka.yandex.ru/account/integration - инструкции

echo "start_XXXX <br>";
$ya_delivery_token = 'y0__xC0ysDLCBix9Bwg9uOJ2hVGIFIiQxxhw_RX1IGrMHU_NBqNxQ';

// $link = "https://b2b-authproxy.taxi.yandex.net/api/b2b/platform/offers/create";
// $link ="b2b.taxi.yandex.net/b2b/cargo/integration/v2/tariffs";

// $link = "https://".  "b2b-authproxy.taxi.yandex.net/api/b2b/platform/pricing-calculator";
// $ya_data = '{"location": "г.Москва, поселение Московский, деревня Саларьево, владение 3, строение 1"}';

echo "<pre>";
$link = "https://"."b2b-authproxy.taxi.yandex.net/api/b2b/platform/pricing-calculator";
$ya_data = '{
    "source": {
        "platform_station_id": "019b46247de07567abd4a410d9d01d04"
    },
    "destination": {
        "address": "Зеленоград, Зеленоград, к362"
    },
    "tariff": "time_interval",
    "total_weight": 1000,
    "total_assessed_price": 1000,
    "client_price": 1000,
    "payment_method": "already_paid",
    "places": [
        {
            "physical_dims": {
                "weight_gross": 1000,
                "dx": 50,
                "dy": 50,
                "dz": 10,
                "predefined_volume": 25000
            }
        }
    ]
}';





$rs = yandex_post_query_with_data($ya_delivery_token, $link, $ya_data);


print_r($rs);







/************************************************************************************************
*
*************************************************************************************************/

function yandex_post_query_with_data($ya_token, $ya_link, $ya_data){

	$ch = curl_init($ya_link);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		'Authorization: Bearer '.$ya_token,
		'Content-Type:application/json',
        'Accept-Language: ru'
	));
	curl_setopt($ch, CURLOPT_POSTFIELDS, $ya_data); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_HEADER, false);
	
	$res = curl_exec($ch);
	
	$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE); // Получаем HTTP-код
	// curl_close($ch);

	if (intdiv($http_code,100) > 2) {
		echo "<br><br>Результат обмена YANDEX (with Data): ".$http_code. "<br>";
				}
	
	$res = json_decode($res, true);
	
	// var_dump($res);
	// die();
	return $res;

}







