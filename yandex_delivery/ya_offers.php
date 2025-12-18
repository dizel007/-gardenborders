<?php
// Получите варианты доставки.
// require_once "yandex_api_functions.php";

// https://dostavka.yandex.ru/account/integration - инструкции

echo "start_ <br>";
$ya_delivery_token = 'y0__xC0ysDLCBix9Bwg9uOJ2hVGIFIiQxxhw_RX1IGrMHU_NBqNxQ';

// $link ="b2b.taxi.yandex.net/b2b/cargo/integration/v2/tariffs";
$link ="b2b.taxi.yandex.net/b2b/cargo/integration/v2/offers/calculate";
$ya_data ='
{
    "items": [
        {
            "size": {
                "length": 0.1,
                "width": 0.2,
                "height": 0.3
            },
            "weight": 2.105,
            "quantity": 1,
            "pickup_point": 1,
            "dropoff_point": 2
        }
    ],
    "route_points": [
        {
            "id": 1,
            "coordinates": [
                0.1,
                0.1
            ],
            "fullname": "Санкт-Петербург, Большая Монетная улица, 1к1А",
            "country": "Россия",
            "city": "Санкт-Петербург",
            "street": "Большая Монетная улица",
            "building": "23к1А",
            "porch": "A",
            "sfloor": "1",
            "sflat": "1"
        }
    ],
    "requirements": {
        "taxi_classes": [
            "cargo"
        ],
        "cargo_type": "van",
        "cargo_loaders": 0,
        "pro_courier": false,
        "cargo_options": [
            "auto_courier"
        ],
        "skip_door_to_door": false,
        "due": "2025-12-17T00:12:00+00:00",
        "rental_duration": 0
    }
}
';

$rs = yandex_post_query_with_data($ya_delivery_token, $link, $ya_data);
print_r($rs);




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

	// if (intdiv($http_code,100) > 2) {
		echo     '<br><br>Результат обмена YANDEX (with Data): '.$http_code. "<br>";
		echo "<pre>";
		print_r($res);
	
		// }
	
	$res = json_decode($res, true);
	
	// var_dump($res);
	// die();
	return $res;

}








$ya_data ='
{
    "start_point": [
        0.1,
        0.1
    ],
    "fullname": "Санкт-Петербург, Большая Монетная улица, 1к1А"
}
';