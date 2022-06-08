@section('css')

@stop

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">{{ trans('trans.cmr-upload') }}</div>
            <div class="card-body">
                <form method="POST" action="{{ route('cmr-upload', $shippment->ref) }}" aria-label="{{ __('Upload') }}">
                    @csrf
                    <div class="form-group row ">
                        <label for="title" class="col-sm-4 col-form-label text-md-right">{{ __('File Upload') }}</label>
                        <div class="col-md-6">
                          <div id="file" class="dropzone"></div>
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Upload') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@section('js')
<script type="text/javascript">
        Dropzone.options.imageUpload = {
            maxFilesize         :       1,
            acceptedFiles: ".jpeg,.jpg,.png,.gif"
        };
</script>
@stop
