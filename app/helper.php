<?php

use App\Models\Dolibarr\llx_const;
use App\Models\Dolibarr\Societe;
use Ramsey\Uuid\Type\Decimal;

function to_money($money)
{
    // $settings = get_settings();
    // return number_format($money,2, $settings->decimals??'.',$settings->separator??',');
    return number_format($money, 2, ',', ' ');
}

function to_money_table($money)
{
    // $settings = get_settings();
    // return number_format($money,2, $settings->decimals??'.',$settings->separator??',');
    return number_format($money, 2, '.', '');
}

function to_number($number)
{
    return (float)$number;
}

// Date
function to_date($date)
{
    return Carbon\Carbon::parse($date)->format('d/m/Y');
}
function to_day($date)
{
    return Carbon\Carbon::parse($date)->format('d');
}
function to_month($date)
{
    return Carbon\Carbon::parse($date)->format('m');
}
function to_year($date)
{
    $date = DateTime::createFromFormat('d/m/Y', $date);
    return Carbon\Carbon::parse($date)->format('Y');
}
function date_excel($date)
{
    return Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($date));
}


function kms_10000($kms)
{
    return round($kms+10000, -4);
}
function to_sqldate($date)
{
    return Carbon\Carbon::parse($date)->format('Y-m-d');
}

function price_HT_fr($price)
{
    return $price/1.2;
}
function price_HT_es($price)
{
    return $price/1.21;
}
function percent($price_new, $price)
{
    return number_format($price_new/$price*100, 2, ',', ' ');
}

function getEntityName($rowid)
{
    $entity = llx_const::where('name', 'MAIN_INFO_SOCIETE_NOM')
        ->where('entity', $rowid)
        ->first();
    $name = $entity->value;

    return $name;
}

function getEntityAddress($rowid)
{
    $entityName = llx_const::where('name', 'MAIN_INFO_SOCIETE_ADDRESS')
        ->where('entity', $rowid)
        ->first();
    $name = $entityName->value;

    return $name;
}

function getEntityZip($rowid)
{
    $entityName = llx_const::where('name', 'MAIN_INFO_SOCIETE_ZIP')
        ->where('entity', $rowid)
        ->first();
    $name = $entityName->value;

    return $name;
}

function getEntityTown($rowid)
{
    $entityName = llx_const::where('name', 'MAIN_INFO_SOCIETE_TOWN')
        ->where('entity', $rowid)
        ->first();
    $name = $entityName->value;

    return $name;
}

function getEntityCountry($rowid)
{
    $entityName = llx_const::where('name', 'MAIN_INFO_SOCIETE_COUNTRY')
        ->where('entity', $rowid)
        ->first();
    $name = $entityName->value;
    $name = explode(':', $name);
    $name = $name[2];
    return $name;
}

function getEntityState($rowid)
{
    $entityName = llx_const::where('name', 'MAIN_INFO_SOCIETE_STATE')
        ->where('entity', $rowid)
        ->first();
    $name = $entityName->value;
    $name = explode(':', $name);
    $name = $name[2];
    return $name;
}

function getEntityVat($rowid)
{
    $entityName = llx_const::where('name', 'MAIN_INFO_TVAINTRA')
        ->where('entity', $rowid)
        ->first();
    $name = $entityName->value;

    return $name;
}

// LACENTRALE
function lac_energy($energy)
{
    if ($energy == 'Essence'){
        return 'ess';
    } elseif ($energy == 'Diesel'){
        return 'dies';
    } elseif ($energy == 'Hybride'){
        return 'hyb';
    } elseif ($energy == 'Electrique'){
        return 'elec';
    }
}
// LEBONCOIN
function leb_energy($energy)
{
    if ($energy == 'Essence'){
        return '1';
    } elseif ($energy == 'Diesel'){
        return '2';
    } elseif ($energy == 'Hybride'){
        return '6';
    } elseif ($energy == 'Electrique'){
        return '4';
    }
}
function leb_text($var)
{
    $var = strtolower($var);
    $var = ucfirst($var);
    return $var;
}

function addressSoc($id)
{
    $soc = Societe::findOrFail($id);
    return
        '<h6>'.$soc->nom.'</h6>
        <p>'.$soc->address.'<br>'
        .$soc->zip.' '.$soc->town.' - '.$soc->country->label.'</p>';
}

function CallAPI($method, $apiKey, $url, $data = false)
{
    $curl = curl_init();
    $httpheader = ['DOLAPIKEY: '.$apiKey];

    switch ($method)
    {
        case "POST":
            curl_setopt($curl, CURLOPT_POST, 1);
            $httpheader[] = "Content-Type:application/json";

            if ($data)
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

            break;
        case "PUT":

	    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PUT');
            $httpheader[] = "Content-Type:application/json";

            if ($data)
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

            break;
        default:
            if ($data)
                $url = sprintf("%s?%s", $url, http_build_query($data));
    }

    // Optional Authentication:
	//    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
	//    curl_setopt($curl, CURLOPT_USERPWD, "username:password");

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl, CURLOPT_HTTPHEADER, $httpheader);

    $result = curl_exec($curl);

    curl_close($curl);

    return $result;
}
