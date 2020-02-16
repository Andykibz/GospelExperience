@section('admin-header')
<legend>{{ $legend }}</legend>
@endsection
    <div class="row">
    <fieldset class="col-sm-8">
            <div class="form-group">
                <label for="page-title">{{ __('Title') }}</label>
            <input type="text" class="form-control" name="title" id="page-title" aria-describedby="page-title" placeholder="Title"  value="{{ $page->title ?? '' }}" required>
                @if ($errors->has('title'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('title') }}</strong>
                    </span>
                @endif
            </div>

            @component('admin.components.inputs.editor',[ 'label'=>'page-body', 'name'=>'body','value'=> $page->body ?? '' ])
            @endcomponent

        </fieldset>
        <fieldset class="col-sm-4">
            <div class="form-group">
                <label for="page-title">{{ __('Page Group') }}</label>
            <input list="groups" type="text" class="form-control" name="group" id="page-group" aria-describedby="page-group" placeholder="Page Group"  value="{{ $page->group ?? '' }}" >
                @if ($errors->has('group'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('group') }}</strong>
                    </span>
                @endif
            </div>
            <datalist id="groups">
                @foreach (App\Page::get()->pluck('group')->unique()->toArray() as $group)
                    <option value="{{ $group }}" />
                @endforeach
            </datalist>
        </fieldset>
    </div>
    <div class="mx-auto mb-5">
        <button class="btn btn-primary btn-block col-sm-8" role="button" type="submit">{{ $submitText }}</button>
    </div>

@section('adminjavascripts')
<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
<script src="/vendor/unisharp/laravel-ckeditor/adapters/jquery.js"></script>

<script>

$(document).ready(function() {
    $('#page-body').ckeditor({
        uiColor: '#eeeeee',
        language: 'en',
        height: '30em',
        filebrowserImageBrowseUrl: '/file-manager/ckeditor'
    });

        });
</script>

@endsection
