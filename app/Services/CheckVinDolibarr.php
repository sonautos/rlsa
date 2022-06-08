<?php
namespace App\Services;

use App\Models\Car;

class CheckVinDolibarr
{
    public function checkBefore (Car $car)
    {
        $car->load('user', 'entity', 'seller', 'categories', 'code_model', 'version', 'tags', 'team');

        $apiKey = config('dolibarr.token');
        $apiUrl = config('dolibarr.url');
        $listProduits = [];
        $produitParam = ["limit" => 10000, "sortfield" => "rowid"];
        $listProduitsResult = CallAPI("GET", $apiKey, $apiUrl."products", $produitParam);
        $listProduitsResult = json_decode($listProduitsResult, true);
        if (isset($listProduitsResult["error"]) && $listProduitsResult["error"]["code"] >= "300") {
        } else {
            foreach ($listProduitsResult as $produit) {
                $listProduits[intval($produit["id"])] = html_entity_decode($produit["ref"], ENT_QUOTES);
            }
        }
        $ref = $car->vin;
        $produitKey = array_search($ref, $listProduits);

        return $produitKey;
    }
}
