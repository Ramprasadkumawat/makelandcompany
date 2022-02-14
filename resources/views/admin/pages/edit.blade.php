@extends('layouts.base')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ "Edit Page" }}</div>

                <div class="card-body">
                    <form method="POST" id="editArtist" action="{{ route('admin.update-page') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>

                            <div class="col-md-6">
                                <input type='hidden' value="{{ $page->id }}" name="id">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{old('title', $page->title)}}" required autocomplete="title" autofocus>

                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="body" class="col-md-4 col-form-label text-md-right">{{ __('Body') }}</label>

                            <div class="col-md-6">
                                <textarea id="body" name="body" class="form-control" rows="7" cols="50" >{{ old('body', $page->body) }}</textarea>

                                @error('body')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ 'Submit' }}
                                </button>
                                <a href="{{url('admin/pages')}}" class="btn btn-danger"> {{ 'Cancle' }}</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('javascript')

<script src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>

<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script type="text/javascript">
    $("#editArtist").validate({
        rules: {
            title: "required",
        },
        messages: {
            'title': "Title field is required.",
        },
        submitHandler: function(form) {
            form.submit();
        }
     });

CKEDITOR.replace( 'body' );
</script>

@endsection
