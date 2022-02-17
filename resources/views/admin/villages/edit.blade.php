@extends('layouts.base')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ "Edit Village" }}</div>

                <div class="card-body">
                    <form method="POST" id="editForm" action="{{ route('admin.update-village') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input type='hidden' value="{{ $village->id }}" name="id">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{old('name', $village->name)}}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Select City') }} </label>

                            <div class="col-md-6">
                                <select name="cityname" class="form-control" id="cityname">
                                    <option value="">Select City</option>
                                    @foreach($cities as $key => $value)
                                    @if($value->id == $village->city_id_FK)
                                    {
                                    <option value="{{$value->id}}" selected>{{$value->name}}</option>
                                    }
                                    @else
                                    {
                                    <option value="{{$value->id}}">{{$value->name}}</option>  
                                    }
                                    @endif
                                    @endforeach
                                </select>
                            
                                @error('cityname')
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
                                <a href="{{url('/admin/villages')}}" class="btn btn-danger"> {{ 'Cancel' }}</a>
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
    $("#editForm").validate({
        rules: {
            name: "required",
            city: "required",
            country: "required",
            email: {
              required: true,
              email: true
            },
            mobile_number:{
              required:true,
              minlength:9,
              maxlength:12,
              number: true
            },
            postcode:{
              required:true,
              minlength:5,
              maxlength:7,
              number: true
            },
            password : {
                minlength : 5
            },
            password_confirmation : {
                minlength : 5,
                equalTo : "#password"
            }
        },
        messages: {
            'name': "Name field is required.",
            'city': "City field is required.",
            'country': "Country field is required.",
            'email': {
                required: "Email field is required.",
                email: "Please input a valid email",
            },
            'mobile_number': {
                required: "Contact number field is required.",
                minlength: "Please input a valid contact nubmer",
                maxlength: "Please input a valid contact nubmer",
                number: "Please input a valid contact nubmer",
            },
            'postcode': {
                required: "Postcode field is required.",
                minlength: "Please input a valid postcode",
                maxlength: "Please input a valid postcode",
                number: "Please input a valid postcode",
            },
        },
        submitHandler: function(form) {
            form.submit();
        }
     });
</script>
@endsection
