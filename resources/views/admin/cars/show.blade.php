@extends('layouts.admin')

@section('styles')
<style>
    img {
        max-width: 100%;
        height: auto;
    }
</style>
    
@endsection

@section('content')

<div class="row">
    <div class="col-md-10">
        <div class="row">
            <div class="col-md-12 text-center">
                <h1 style="font-size: 26px; text-transform: uppercase"> <a href="#"><b>{{ $car->name }}</b></a> <br></h1>
                <p style="font-size: 20px; text-transform: uppercase">
                    {{ trans('trans.Ref')}} : {{ $car->id}} - {{ $car->vin }}<br>
                    {{trans('trans.Options')}} : {{ $car->feature }}
                </p>
            </div>
        </div>
        <div class="row pt-5">
            <div class="col-md-6">
                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                    </ol>
                    <div class="carousel-inner">
                        @foreach($car->version->image as $key => $media)
                        <div class="carousel-item {{$key == 0 ? 'active' : '' }}">
                            <img src="{{ $media->getUrl() }}" class="d-block w-100"  alt="..." style="max-height: 400px; widht: auto">
                        </div>
                        @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#myCarousel" role="button"  data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true">     </span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
            <div class="col-md-2 mx-auto">
                <div class="card shadow">
                    <div class="card-body">
                        <table class="table table-sm table-hover">
                            <tbody>
                                <tr>
                                    <td class="text-right">{{ trans('vehicle.mec')}} : </td>
                                    <td>{{ ($car->mec) }}</td>
                                </tr>
                                <tr>
                                    <td class="text-right">{{ trans('vehicle.kms')}} : </td>
                                    <td>{{ $car->kms }}</td>
                                </tr>
                                <tr>
                                    <td class="text-right">{{trans('vehicle.energy')}} : </td>
                                    <td>{{ $car->version->energy ?? $car->energy }}</td>
                                </tr>
                                <tr>
                                    <td class="text-right">{{trans('vehicle.ch')}} : </td>
                                    <td>{{ $car->version->ch ?? $car->ch }} cv</td>
                                </tr>
                                <tr>
                                    <td class="text-right">{{trans('vehicle.co2')}} : </td>
                                    <td>{{ $car->version->co_2 ?? $car->co_2 }} g/KM</td>
                                </tr>
                                <tr>
                                    <td class="text-right">{{ trans('vehicle.gear' )}} : </td>
                                    <td>{{ $car->version->gear ?? $car->gear }}</td>
                                </tr>
                                <tr>
                                    <td class="text-right">{{ trans('trans.stock')}} : </td>
                                    @if ($car->qty == 1)
                                        <td><span class="badge bg-success">{{ trans('trans.yes')}}</span></td>
                                    @else
                                        <td><span class="badge bg-danger">{{ trans('trans.no')}}</span></td>
                                    @endif
                                </tr>
                                <tr>
                                    <td class="text-right">{{ trans('trans.orign')}} : </td>
                                    <td>{{ $car->warehouse }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-2 mx-auto">
                <div class="card bg-success shadow text-center my-auto py-3" id="cardPrice">
                    <p>{{ trans('trans.priceNew')}} : {{ to_money($car->price_new) }} € TTC</p>
                    <p>{{ trans('trans.priceToSell' )}} : {{ to_money($car->price_ht) }} € HT</p>
                    <p>{{ trans('trans.discount' )}} : {{ to_money(price_HT_fr($car->price_new)-$car->price_ht) }} € HT</p>
                    <p>{{ trans('trans.discountPercent' )}} : {{ percent(price_HT_fr($car->price_new)-$car->price_ht, price_HT_fr($car->price_new)) }} %</p>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div>
                <button class="btn btn-outline-dark col" type="button" data-toggle="collapse" data-target="#serie" aria-expanded="false" aria-controls="serie" style="text-transform: capitalize">
                    {{ trans('vehicle.equipments')}} {{ trans('trans.of')}} {{ trans('vehicle.serie')}}
                </button>
            </div>
            <div class="collapse" id="serie">
                <div class="card card-body">
                    {{ $car->version->equipment ?? $car->equipment }}
                </div>
            </div>
        </div>
        <div class="col-md-12 pt-3">
            <div class="card shadow mx-auto">
                <div class="card-header">
                    <h3>{{ trans('vehicle.simalar')}}</h3>
                </div>
                <div class="card-body text-center mx-auto">
                    <table class="table table-hover table-responsive" style="width: 100%">
                        <thead>
                            <tr>
                                <td>{{ trans('vehicle.idv')}}</td>
                                <td>{{ trans('vehicle.description') }}</td>
                                <td>{{ trans('vehicle.color') }}</td>
                                <td>{{ trans('vehicle.mec') }}</td>
                                <td>{{ trans('vehicle.kms') }}</td>
                                <td>{{ trans('vehicle.frevo') }}</td>
                                <td>{{ trans('vehicle.price') }}</td>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @foreach ($psimilars as $psimilar)
                            <tr>
                                <td>{{ $psimilar->id }}</td>
                                <td>{{ $psimilar->name }}</td>
                                <td>{{ $psimilar->color }}</td>
                                <td>{{ ($psimilar->mec) }}</td>
                                <td>{{ $psimilar->kms }}</td>
                                <td>{{ $psimilar->frevo }}</td>
                                <td>{{ $psimilar->price }}</td>
                            </tr>
                            @endforeach --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-2">
        <div class="card shadow" style="height: 100%">
            <div class="btn-group-vertical p-3" role="group" aria-label="Vertical button group">
                <a class="btn btn-link" href="{{'https://www.lacentrale.fr/listing?energies='.lac_energy($car->energy).'&makesModelsCommercialNames='.$car->make.'%3A'.$car->modele.'&mileageMax='.kms_10000($car->kms).'&sortBy=priceAsc&versions='.$car->ch.'%2C'.$car->version.'&yearMin='.to_year($car->mec).''}}" target="_blank" type="button"><img src="{{asset('img/buttons/logo_lacentrale.png')}}" alt="lacentrale"></a>
                <a class="btn btn-link" href="{{'https://www.leboncoin.fr/recherche?category=2&text='.$car->ch.'%20'.$car->name.'&sort=price&order=asc&brand='.leb_text($car->make).'&model='.leb_text($car->modele).'&fuel='.leb_energy($car->energy).'&regdate='.to_year($car->mec).'-max&mileage=min-'.kms_10000($car->kms).''}}" target="_blank" type="button"><img src="{{asset('img/buttons/leboncoin.png')}}" alt="leboncoin"></a>
                <a class="btn btn-link" href="{{'https://www.autoscout24.fr/lst/'.$car->make.'/'.$car->modele.'?sort=price&desc=0&ustate=N%2CU&size=20&page=1&cy=F&version0='.$car->name.'%20'.$car->ch.'&kmto='.kms_10000($car->kms).'&fregfrom='.to_year($car->mec).'&atype=C&fc=8&qry=&'}}" target="_blank" type="button"><img src="{{asset('img/buttons/autoscout24.png')}}" alt="autoscout24"></a>
            </div>
            <form action="{{ route('admin.car-fiche.pdf') }}" method="POST">
                @csrf
                <input type="hidden" name="id" id="" value="{{ $car->id }}">
                <button class="text-white bg-green-600 hover:bg-green-200 hover:text-black p-2 rounded" type="submit">
                    {{trans('trans.print')}}
                </button>
            </form>
        </div>
    </div>
</div>

@endsection