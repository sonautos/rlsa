<?php
namespace App\Services;

use App\Models\Car;
use App\Models\OrdersList;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class Commandes
{
    public function create(OrdersList $order)
    {
        $order->load('orderShippLines', 'orderOrderLines', 'entity', 'seller', 'client', 'task', 'author', 'valid', 'user_updated', 'status', 'cond_reglement', 'mode_reglement', 'shipping_method', 'delivery_address', 'team');

        $apiKey = config('dolibarr.token');
        $apiUrl = config('dolibarr.url');
        $newCommandeClient = 0;
        $newCommandeSeller = 0;

        // COMMANDE CLIENT
        if (isset($order->client) && $order->orderOrderLines->sum('comclient') > 0 ) {

            $clientSearch = json_decode(CallAPI("GET", $apiKey, $apiUrl."thirdparties", array(
                "sortfield" => "t.rowid",
                "sortorder" => "ASC",
                "limit" => "1",
                "mode" => "1",
                "sqlfilters" => "(t.tva_intra:=:'".$order->client->vatnumber."')"
                )
            ), true);
            if (isset($clientSearch["error"])) {
                $newClient = [
                    "name" 			=> $order->client->name,
                    "address"		=> $order->client->address,
                    "zip"           => $order->client->zip,
                    "town"          => $order->client->city,
                    "country"       => $order->client->country,
                    "email"         => $order->client->email,
                    "tva_intra"     => $order->client->vatnumber,
                    "client" 		=> "1",
                    "code_client"	=> "-1"
                ];
                $newClientResult = CallAPI("POST", $apiKey, $apiUrl."thirdparties", json_encode($newClient));
                $newClientResult = json_decode($newClientResult, true);
                $clientDoliID = $newClientResult;
                $clientDoliCountry = $order->client->country;
            } else {
                foreach ($clientSearch as $key => $value) {
                    $clientDoliID = $value['id'];
                    // $clientDoliCountry = $value['country'];
                }
            }
            // if ($clientDoliCountry == $order->entity->country)
            $newCommandeLine = [];
            foreach($order->orderOrderLines as $line) {


                // Product.
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
                $ref = $line->vehicle->vin;
                $label = $line->vehicle->name;
                $produitKey = array_search($ref, $listProduits);

                if ($produitKey) {
                    $fk_product = $produitKey;
                } else {
                    $newProduct = [
                        "ref"	=> $ref,
                        "label"	=> $label,
                        "type" => 1,
                        "price" => 150,
                        "tva_tx" => 21
                    ];
                    $newProductResult = CallAPI("POST", $apiKey, $apiUrl."products", json_encode($newProduct));
                    $newProductResult = json_decode($newProductResult, true);
                    if (isset($newProductResult["error"]) && $newProductResult["error"]["code"] >= "300") {
                        echo "<pre>ERROR", var_dump($newProductResult), "</pre>";
                        exit;
                    } else {
                    $fk_product = $newProductResult;
                    $listProduits[$fk_product] = $ref;
                    }
                }

                if ($order->client->country == "Espagne" && $order->entity->name == "RLSA") {
                    $tax = 21.000;
                    $localtax2_tx = -7.000;
                    $localtax1_type = 3;
                    $localtax2_type = 5;
                }

                // End Product
                $newCommandeLine[] = [
                    "desc"		=> "Brokerage Service",
                    "subprice"	=> $line->comclient,
                    "qty"		=> 1,
                    "fk_product"=> $fk_product,
                    "tva_tx"	=> isset($tax) ? $tax : 0,
                    // "localtax1_tx" => "0.000",
                    // "localtax2_tx" => isset($localtax2_tx) ? $localtax2_tx : 0,
                    // "localtax1_type" => isset($localtax1_type) ? $localtax1_type : 0,
                    // "localtax2_type" => isset($localtax2_type) ? $localtax2_type : 0,
                ];
            }

            if (count($newCommandeLine) > 0) {
                $newCommande = [
                    "socid"			=> $clientDoliID,
                    "type" 			=> "0",
                    "date"          => Carbon::parse(now())->format('Y-m-d'),
                    "date_livraison"=> Carbon::createFromFormat(config('panel.date_format'), $order->date_livraison)->format('Y-m-d'),
                    "delivery_date" => Carbon::createFromFormat(config('panel.date_format'), $order->date_livraison)->format('Y-m-d'),
                    "lines"			=> $newCommandeLine,
                    "cond_reglement_id" => "1",
                    "shipping_method_id" => "2",
                    "cond_reglement_code" => "RECEP",
                    "mode_reglement" => "Transfer",
                    "mode_reglement_id" => "2",
                    "mode_reglement_code" => "VIR",
                    "note_public"   => "Order : ".$order->ref,
                    "note_private"	=> "Commande importée automatiquement depuis l'application",
                    "cond_reglement_doc" => "Due upon receipt",
                ];
                $newCommandeClient = CallAPI("POST", $apiKey, $apiUrl."orders", json_encode($newCommande));
                $newCommandeClient = json_decode($newCommandeClient, true);

                // Valider une commande
                // $newCommandeValider = [
                //     "idwarehouse"	=> "0",
                //     "notrigger"		=> "0"
                // ];
                // $newCommandeValiderClient = CallAPI("POST", $apiKey, $apiUrl."orders/".$newCommandeClient."/validate", json_encode($newCommandeValider));
                // $newCommandeValiderClient = json_decode($newCommandeValiderClient, true);
            }
        }

        // COMMANDE FOURNISSEUR
        if (isset($order->seller)) {
            $clientSearch = json_decode(CallAPI("GET", $apiKey, $apiUrl."thirdparties", array(
                "sortfield" => "t.rowid",
                "sortorder" => "ASC",
                "limit" => "1",
                "mode" => "1",
                "sqlfilters" => "(t.tva_intra:=:'".$order->seller->vatnumber."')"
                )
            ), true);

            if (isset($clientSearch["error"])) {
                $newClient = [
                    "name" 			=> $order->seller->name,
                    "address"		=> $order->seller->address,
                    "zip"           => $order->seller->zip,
                    "town"          => $order->seller->city,
                    "email"         => $order->seller->email,
                    "tva_intra"     => $order->seller->vat_number,
                    "client" 		=> "1",
                    "code_client"	=> "-1",
                    "fournisseur"   => "1",
                    "code_fournisseur" => "-1"
                ];
                $newClientResult = CallAPI("POST", $apiKey, $apiUrl."thirdparties", json_encode($newClient));
                $newClientResult = json_decode($newClientResult, true);
                $clientDoliID = $newClientResult;
                $sellerDoliCountry = $order->seller->country;
            } else {
                foreach ($clientSearch as $key => $value) {
                    $clientDoliID = $value['id'];
                    // $sellerDoliCountry = $value['country'];
                }
            }
            $newCommandeLine = [];
            foreach($order->orderOrderLines as $line) {
                if ($line->vehicle->sum('comseller') > 0 ) {
                    // Product.
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
                    $ref = $line->vehicle->vin;
                    $label = $line->vehicle->name;
                    $produitKey = array_search($ref, $listProduits);

                    if ($produitKey) {
                        $fk_product = $produitKey;
                    } else {
                        $newProduct = [
                            "ref"	=> $ref,
                            "label"	=> $label,
                            "type" => 1,
                            "price" => 150,
                            "tva_tx" => 21,
                        ];
                        $newProductResult = CallAPI("POST", $apiKey, $apiUrl."products", json_encode($newProduct));
                        $newProductResult = json_decode($newProductResult, true);
                        if (isset($newProductResult["error"]) && $newProductResult["error"]["code"] >= "300") {
                            echo "<pre>ERROR", var_dump($newProductResult), "</pre>";
                            exit;
                        } else {
                        $fk_product = $newProductResult;
                        $listProduits[$fk_product] = $ref;
                        }
                    }
                    if ($order->seller->country == "Espagne" && $order->entity->name == "RLSA") {
                        $tax = 21.000;
                        $localtax2_tx = -7.000;
                        $localtax1_type = 3;
                        $localtax2_type = 5;
                    }

                    // End Product
                    $newCommandeLine[] = [
                        "desc"		=> "Brokerage Service",
                        "subprice"	=> $line->vehicle->comseller,
                        "qty"		=> 1,
                        "fk_product"=> $fk_product,
                        "tva_tx"	=> isset($tax) ? $tax : 0,
                        // "localtax1_tx" => "0.000",
                        // "localtax2_tx" => isset($localtax2_tx) ? $localtax2_tx : 0,
                        // "localtax1_type" => isset($localtax1_type) ? $localtax1_type : 0,
                        // "localtax2_type" => isset($localtax2_type) ? $localtax2_type : 0,
                    ];
                }
            }

            if (count($newCommandeLine) > 0) {
                $newCommande = [
                    "socid"			=> $clientDoliID,
                    "type" 			=> "0",
                    "date"          => Carbon::parse(now())->format('Y-m-d'),
                    "date_livraison"=> Carbon::createFromFormat(config('panel.date_format'), $order->date_livraison)->format('Y-m-d'),
                    "delivery_date" => Carbon::createFromFormat(config('panel.date_format'), $order->date_livraison)->format('Y-m-d'),
                    "lines"			=> $newCommandeLine,
                    "cond_reglement_id" => "1",
                    "shipping_method_id" => "2",
                    "cond_reglement_code" => "RECEP",
                    "mode_reglement" => "Transfer",
                    "mode_reglement_id" => "2",
                    "mode_reglement_code" => "VIR",
                    "note_public"   => "Order : ".$order->ref,
                    "note_private"	=> "Commande importée automatiquement depuis l'application",
                    "cond_reglement_doc" => "Due upon receipt",
                ];
                $newCommandeSeller = CallAPI("POST", $apiKey, $apiUrl."orders", json_encode($newCommande));
                $newCommandeSeller = json_decode($newCommandeSeller, true);

                // Valider une commande
                // $newCommandeValider = [
                //     "idwarehouse"	=> "0",
                //     "notrigger"		=> "0"
                // ];
                // $newCommandeValiderSeller = CallAPI("POST", $apiKey, $apiUrl."orders/".$newCommandeSeller."/validate", json_encode($newCommandeValider));
                // $newCommandeValiderSeller = json_decode($newCommandeValiderSeller, true);
            }
        }

        return ['CommandeClientRef' => $newCommandeClient, 'CommandeSellerRef' => $newCommandeSeller];
    }
}
