@extends('layouts.admin')

@section('styles')
<style>
</style>
@endsection

@section('content')

    @if (session()->has('message'))
    <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert">
        <div class="flex">
            <div class="text-center">
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

    <form action="{{ route('admin.bulk-options') }}" method="POST">
        @csrf
        <input type="hidden" name="csv_data_id" value="{{ $data->id }}" />
        <div class="card col-md-12 mx-auto">
            <div class="table">
                <table>
                    <thead>
                        <tr>
                            <th>code</th>
                            <th>make</th>
                            <th>modele</th>
                            <th>name</th>
                            <th>description</th>
                            <th>search</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($options as $key => $value)
                        @if ($value == null)
                        <tr>
                            <td>
                                <input class="input border bg-light" type="text" name="code[]" value="{{ $key }}" readonly>
                            </td>
                            <td>
                                <select name="make[]" id="make" class="border bg-light" selected required>
                                    <option value=''>{{ trans('trans.select') }}</option>
                                    @foreach($brands as $brand)
                                        <option value="{{ $brand->id }}"
                                            {{ isset($make) && $make->name == $brand->name ? "selected" : '' }}
                                            >{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <select name="modele[]" id="modele" class="border bg-light" selected>
                                    <option value=''>{{ trans('trans.select') }}</option>
                                    @foreach($models as $model)
                                        <option value="{{ $model->id }}"
                                            {{-- {{ isset($modele) && $modele->name == $model->name ? 'selected' : '' }} --}}
                                            >{{ $model->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <input class="input" type="text" name="name[]" placeholder="{{ trans('trans.enterOption') }}" value="{{ old('name', '') }}" required>
                            </td>
                            <td class="w-25">
                                <textarea class="input" type="text" name="description[]" placeholder="{{ trans('trans.enter') }} {{ trans('trans.description') }}" cols="40">value="{{ old('description', '') }}"</textarea>
                            </td>
                            <td><a href="{{'https://www.google.fr/search?q="'.$key.'"+'.$make->name.''}}" target="_blank"><i class="fab fa-google"></i></a></td>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-outline-success">{{ trans('trans.save') }}</button>
            </div>
        </div>
    </form>
@stop

@section('css')
@stop

@section('js')
<script>
    $(document).ready(function() {
        $('#parse').DataTable( {
            "autoWidth": true,
            "pageLength": 5,
            "scrollX" : true
        } );
    } );
</script>
@stop
