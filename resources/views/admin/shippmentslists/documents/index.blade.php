@extends('layouts.admin')

@section('style')
<link href="{{ asset('css/select2.css') }}" rel="stylesheet">
<link href="{{ asset('css/dropzone.min.css') }}" rel="stylesheet">
    <style>
        h3{
            text-transform: uppercase;
        }
    </style>
@stop

@section('content')

<div class="container pb-2">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="navbar-collapse collapse w-100 dual-collapse2 order-1 order-md-0">
            <ul class="navbar-nav ml-auto text-center">
                <li class="nav-item px-3">
                    <a class="navbar-brand" href="{{ route('admin.shippmentslists.show', [$shippment->id]) }}">{{ trans('trans.Resume')}}</a>
                </li>
            </ul>
        </div>
        <div class="navbar-collapse collapse w-100 dual-collapse2 order-2 order-md-2">
            <ul class="navbar-nav mr-auto text-center">
                <li class="nav-item active px-3">
                    <a class="navbar-brand" href="{{ route('admin.shipp-docs.show', [$shippment->id]) }}">{{ trans('trans.Documents')}}</a>
                </li>
            </ul>
        </div>
    </nav>
</div>

@if (session()->has('message'))
<div class="bg-teal-600 border-t-4 border-teal-500 rounded-b px-4 py-3 shadow-md my-3 center-align" role="alert">
    <div class="flex">
        <div class="">
            <p class="text-sm">{{ session('message') }}</p>
        </div>
    </div>
</div>
@endif
@if (count($errors) > 0)
<div class = "bg-danger text-black shadow text-center rounded-bottom">
    <ul>
    @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
    </ul>
</div>
@endif

<div class="container-fluid">
    <div class="fade-in">
        <div class="row">
            <div class="card col-lg-10 shadow pb-2 mx-auto" style="font-size: small">
                <div class="card-header text-center">
                    {{ trans('trans.attestation')}}
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2"><span style="text-transform: uppercase"><b>{{ trans('trans.Client')}}</b></span><b></b></div>
                        <div class="col-md-2"><span style="text-transform: uppercase"><b>{{ trans('trans.Supplier')}}</b></span><b></b></div>
                        <div class="col-md-2"><span style="text-transform: uppercase"><b>{{ trans('trans.Attestation')}}</b></span><b></b></div>
                        <div class="col-md-2"><span style="text-transform: uppercase"><b>{{ trans('trans.download')}}</b></span><b></b></div>
                        <div class="col-md-2"><span style="text-transform: uppercase"><b>{{ trans('trans.Cerfa')}}</b></span><b></b></div>
                        <div class="col-md-2"><span style="text-transform: uppercase"><b>{{ trans('trans.Cerfa-download')}}</b></span><b></b></div>
                    </div>
                    @foreach ($clients as $key => $client)
                    @foreach ($client->groupBy('seller_id') as $kseller => $vseller)
                    <div class="row">
                        <div class="col-md-2">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    @foreach ($companies->where('id', $key) as $company)
                                        {{ $company->name }}
                                    @endforeach
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-2">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    @foreach ($companies->where('id', $kseller) as $company)
                                        {{ $company->name }}
                                    @endforeach
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-2">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <form action="{{ route('admin.receptionPDF') }}" method="POST">
                                        @csrf
                                        <input type="text" name="seller" value="{{ $kseller }}" hidden>
                                        <input type="text" name="client" value="{{$key}}" hidden>
                                        <input type="text" name="key" value="{{$shippment->ref}}" hidden>
                                        @foreach ($client as $clients)
                                            <input type="text" name="id[]" value="{{ $clients->id }}" hidden>
                                        @endforeach
                                        <button class="text-white bg-green-600 hover:bg-green-200 hover:text-black p-1 rounded" type="submit">
                                            {{trans('trans.print')}}
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-2">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">

                                </li>
                            </ul>
                        </div>
                        <div class="col-md-2">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <form action="{{ route('admin.cerfa', ['key' => $key, 'seller' => $kseller, 'ref' => $shippment->ref]) }}" method="POST">
                                        @csrf
                                        @foreach ($client as $clients)
                                            <input type="text" name="id[]" value="{{ $clients->id }}" hidden>
                                        @endforeach
                                        <button class="text-white bg-green-600 hover:bg-green-200 hover:text-black p-1 rounded" type="submit">
                                            {{trans('trans.print')}}
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-2">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    @if ($cmr != 0)
                                        <a href="{{ $cmr }}" target="_blank">{{ trans('global.downloadFile') }}</a>
                                    @endif
                                </li>
                            </ul>
                        </div>
                    </div>
                    @endforeach
                    @endforeach
                </div>
            </div>

            <div class="card col-lg-8 shadow pb-2 mx-auto">
                <div class="card-header text-center">
                    {{ trans('trans.CMR')}}
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <form method="POST" action="{{ route("admin.trucks.update", [$shippment->shippmentTrucks->id]) }}" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <label for="cmr">{{ trans('cruds.truck.fields.cmr') }}</label>
                                <div class="needsclick dropzone {{ $errors->has('cmr') ? 'is-invalid' : '' }}" id="cmr-dropzone">
                                </div>
                                @if($errors->has('cmr'))
                                    <span class="text-danger">{{ $errors->first('cmr') }}</span>
                                @endif
                                <span class="help-block">{{ trans('cruds.truck.fields.cmr_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-danger" type="submit">
                                    {{ trans('global.save') }}
                                </button>
                            </div>
                        </form>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('scripts')
<script>
    Dropzone.options.cmrDropzone = {
        url: '{{ route('admin.trucks.storeMedia') }}',
        maxFilesize: 2, // MB
        maxFiles: 1,
        addRemoveLinks: true,
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        params: {
        size: 2
        },
        success: function (file, response) {
        $('form').find('input[name="cmr"]').remove()
        $('form').append('<input type="hidden" name="cmr" value="' + response.name + '">')
        },
        removedfile: function (file) {
        file.previewElement.remove()
        if (file.status !== 'error') {
            $('form').find('input[name="cmr"]').remove()
            this.options.maxFiles = this.options.maxFiles + 1
        }
        },
        init: function () {
            @if(isset($$shippment->shippmentTrucks) && $$shippment->shippmentTrucks->cmr)
                var file = {!! json_encode($$shippment->shippmentTrucks->cmr) !!}
                    this.options.addedfile.call(this, file)
                file.previewElement.classList.add('dz-complete')
                $('form').append('<input type="hidden" name="cmr" value="' + file.file_name + '">')
                this.options.maxFiles = this.options.maxFiles - 1
            @endif
        },
        error: function (file, response) {
            if ($.type(response) === 'string') {
                var message = response //dropzone sends it's own error messages in string
            } else {
                var message = response.errors.file
            }
            file.previewElement.classList.add('dz-error')
            _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
            _results = []
            for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                node = _ref[_i]
                _results.push(node.textContent = message)
            }

            return _results
        }
    }
</script>
@endsection
