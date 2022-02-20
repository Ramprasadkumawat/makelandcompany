@extends('layouts.base')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ "Edit Cold-Store" }}</div>

                <div class="card-body">
                    <form method="POST" id="editForm" action="{{ route('admin.update-cold-store') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input type='hidden' value="{{ $coldstore->id }}" name="id">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{old('name', $coldstore->name)}}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="stock_name" class="col-md-4 col-form-label text-md-right">{{ __('Stock Name') }}</label>

                            <div class="col-md-6">
                                <input id="stock_name" type="text" class="form-control @error('stock_name') is-invalid @enderror" name="stock_name" value="{{old('name', $coldstore->stock_name)}}" required autocomplete="stock_name" autofocus>

                                @error('stock_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="weigth" class="col-md-4 col-form-label text-md-right">{{ __('Weigth') }}</label>

                            <div class="col-md-3">
                                <input id="weigth" type="number" class="form-control @error('weigth') is-invalid @enderror" name="weigth" value="{{old('name', $coldstore->weigth)}}" required autocomplete="weigth" autofocus>

                                @error('weigth')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <select name="type" class="form-control" id="type">
                                    <option value="">Select Type</option>
                                    <option value="quintal">Quintal</option>
                                    <option value="killogram">Killogram</option>
                                    <option value="gram">Gram</option>

                                    @if($coldstore->type == 'quintal')
                                    {
                                    <option value="quintal" selected>Quintal</option>
                                    }
                                    @elseif($coldstore->type == 'killogram')
                                    {
                                    <option value="killogram" selected>Killogram</option> 
                                    }
                                    @elseif($coldstore->type == 'gram')
                                    {
                                    <option value="gram" selected>Gram</option>
                                    }
                                    @endif  
                                </select>

                                @error('type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="cityname" class="col-md-4 col-form-label text-md-right">{{ __('Select City') }}</label>

                            <div class="col-md-6">

                                <select name="cityname" class="form-control" id="cityname">
                                    <option value="">Select City</option>
                                    @foreach($cities as $key => $value)
                                    @if($value->id == $coldstore->city_id_FK)
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
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="villagename" class="col-md-4 col-form-label text-md-right">{{ __('Select Village') }}</label>

                            <div class="col-md-6">

                                <select name="villagename" class="form-control" id="villagename">
                                    <option value="">Select Village --Optional</option>
                                    @foreach($village as $key => $value)
                                    @if($value->id == $coldstore->village_id_FK)
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
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="amount" class="col-md-4 col-form-label text-md-right">{{ __('Amount') }}</label>

                            <div class="col-md-6">
                                <input id="amount" type="number" class="form-control @error('amount') is-invalid @enderror" name="amount" value="{{old('name', $coldstore->amount)}}" required autocomplete="amount" autofocus>

                                @error('amount')
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
