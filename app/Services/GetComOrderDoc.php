<?php
namespace App\Services;

use App\Models\OrdersList;
use Storage;

class GetComOrderDoc
{
    public function getDoc ($order)
    {
        $apiKey = config('dolibarr.token');
        $apiUrl = config('dolibarr.url');

        $order = CallAPI("GET", $apiKey, $apiUrl."orders/".$order);
        $orderResult = json_decode($order, true);

        $path = $orderResult['ref']."/".$orderResult['ref'].".pdf";

        $orderParam = [
            "modulepart" => "order",
            "original_file" => $path,
            "doctemplate" => "einstein",
            "langcode" => "fr_FR"
        ];
        $createDocOrder = CallAPI("PUT", $apiKey, $apiUrl."documents/builddoc", json_encode($orderParam));
        $createDocOrderResult = json_decode($createDocOrder, true);

        $fileParam = [
            "modulepart" => "order",
            "original_file" => $path
        ];
        $getFile = CallAPI("GET", $apiKey, $apiUrl."documents/download", $fileParam);
        $doc = json_decode($getFile, true);
        return $doc;
        $decoded = base64_decode($doc['content']);
        return $decoded;
    }
}