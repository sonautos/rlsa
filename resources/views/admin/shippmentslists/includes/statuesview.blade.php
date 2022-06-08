
<p style="text-align: center">
@if($statues == 0)
    <span class="badge badge-inline badge-warning">{{trans('trans.draft')}}</span>
@elseif($statues == 1)
    <span class="badge badge-inline badge-primary">{{trans('trans.Validated')}}</span>
@elseif($statues == 2)
    <span class="badge badge-inline badge-dark" value='en cours'>{{trans('trans.In process')}}</span>
@elseif($statues == 3)
    <span class="badge badge-inline badge-success">{{trans('trans.Delivered')}}</span>
@endif
</p>
