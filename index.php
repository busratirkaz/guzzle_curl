<?php

require 'vendor/autoload.php';

use GuzzleHttp\Client;

// Döviz kuru çekmek için API URL'si
$apiUrl = 'https://api.exchangerate-api.com/v4/latest/USD';

// Guzzle ile HTTP isteği gönderme
$client = new Client();
$response = $client->get($apiUrl);
$data = json_decode($response->getBody(), true);

/* 
echo '<pre>';
 var_dump($response); 
echo '</pre>'; */


/* echo '<pre>';
 var_dump($data); 
echo '</pre>'; */


// İstenilen döviz kurları
$currencies = [
    'USD' => 'Amerikan Doları',
    'TRY' => 'Türk Lirası',
];

// HTML çıktısı için değişkenler
$html = '<!DOCTYPE html>
<html>
<head>
    <title>Döviz Kurları</title>
    <style>
        table {
            border-collapse: collapse;
            width: 400px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Döviz Kurları</h1>
    <table>
        <tr>
            <th>Döviz Birimi</th>
            <th>Kur</th>
        </tr>';

foreach ($currencies as $currency => $currencyName) {
    $html .= '
        <tr>
            <td>' . $currency . ' - ' . $currencyName . '</td>
            <td>' . $data['rates'][$currency] . '</td>
        </tr>';
}

$html .= '
    </table>
</body>
</html>';

// HTML çıktısını ekrana yazdırma
echo $html;

?>
