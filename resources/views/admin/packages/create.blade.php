@extends('layouts.base')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ "Create Package" }}</div>

                <div class="card-body">
                    <form method="POST" id="createForm" action="{{ route('admin.store-package') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="critiques" class="col-md-4 col-form-label text-md-right">{{ __('Critiques') }}</label>

                            <div class="col-md-6">
                                <input id="critiques" type="number" class="form-control @error('critiques') is-invalid @enderror" name="critiques" value="{{ old('critiques') }}" required min="1">

                                @error('critiques')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="coins" class="col-md-4 col-form-label text-md-right">{{ __('Coins') }}</label>

                            <div class="col-md-6">
                                <input id="coins" type="number" class="form-control @error('coins') is-invalid @enderror" name="coins" value="{{ old('coins') }}" required min="1">

                                @error('coins')
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
                                <a href="{{url('/admin/packages')}}" class="btn btn-danger"> {{ 'Cancle' }}</a>
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

<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script type="text/javascript">
    $("#createForm").validate({
        rules: {
            name: "required",
            critiques:{
              required:true,
              number: true
            },
            coins:{
              required:true,
              number: true
            }
        },
        messages: {
            'name': "Name field is required.",
            'critiques': {
                required: "Critiques field is required.",
            },
            'coins': {
                required: "Coins field is required.",
            }
        },
      submitHandler: function(form) {
        form.submit();
      }
     });

</script>

@endsection
