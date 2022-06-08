@extends('layouts.user')

@section('css')
    <style>
        .btn-large {
            margin-bottom: 30px;
        }
        #account a {
            width: 100%;
        }
    </style>
@endsection
@section('content')
    <div class="container" id="account">
        <h2>{{trans('user.my-account')}}</h2>
        <div class="row">
            <div class="col s12 m6"><a href="#" class="btn-large"><i class="material-icons left">person</i>Mes Données personnelles</a></div>
            <div class="col s12 m6"><a href="#" class="btn-large"><i class="material-icons left">location_on</i>Mes Adresses</a></div>
            {{-- <div class="col s12 m6"><a href="#" class="btn-large @unless($orders) disabled @endif"><i class="material-icons left">shopping_cart</i>Mes Commandes</a></div> --}}
            <div class="col s12 m6"><a href="#" class="btn-large"><i class="material-icons left">shopping_cart</i>Mes Commandes</a></div>
            <div class="col s12 m6"><a href="#" class="btn-large"><i class="material-icons left">visibility</i>RGPD</a></div>  
        </div>
    </div>
@endsection