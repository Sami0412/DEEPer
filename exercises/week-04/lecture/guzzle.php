<?php

require_once 'setup.php';

use GuzzleHttp\Exception\GuzzleException;

$client = new GuzzleHttp\Client([
    'base_uri' => 'https://api.jokes.one'
]);

try {
    $response = $client->get('/jod');
    $responseData = $response->getBody()->getContents();
    $decodedResponse = json_decode($responseData);

    var_dump($responseData);

    $joke = $decodedResponse->contents->jokes[0]->joke->text;

    echo nl2br($joke);

} catch (GuzzleException $e) {
    echo "Error: " . $e->getMessage();
}