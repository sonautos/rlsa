
{{-- @unless ( empty($selected) )
    <a href="{{ route('shippment.create', ['rowid' => $selected] ) }}" target="_blank" class="p-2 bg-green-300 text-green-500 hover:bg-green-600 hover:text-white rounded">{{ trans('trans.new_shippment') }} -
        <span class="badge badge-light p-1">{{ count($selected) }}</span>
    </a>
@endunless --}}

@unless ( empty($selected) )
    <a href="{{ route('shippment.create', ['rowid' => $selected] ) }}" target="_blank" class="" id="addLine"><h3>{{ count($selected) }}</h3></a>
@endunless
