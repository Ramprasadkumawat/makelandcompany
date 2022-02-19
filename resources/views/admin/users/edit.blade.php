@extends('layouts.base')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ "Edit User" }}</div>

                <div class="card-body">
                    <form method="POST" id="editForm" action="{{ route('admin.update-user') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input type='hidden' value="{{ $user->id }}" name="id">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{old('name', $user->name)}}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }} </label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{old('email', $user->email)}}" autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Contact Number') }}</label>

                            <div class="col-md-6">
                                <input id="mobile_number" type="text"  class="form-control @error('mobile_number') is-invalid @enderror" name="mobile_number" value="{{old('mobile_number', $user->mobile_number)}}" required >

                                @error('mobile_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                         
                        <div class="form-group row">
                            <label for="city_id" class="col-md-4 col-form-label text-md-right">{{ __('City') }}</label>

                            <div class="col-md-6">

                                <select name="city_id" class="form-control" id="city_id">
                                    <option value="">Select City</option>
                                    @foreach($cities as $key => $value)
                                    @if($value->id == $user->city_id_FK)
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
                            <label for="village_id" class="col-md-4 col-form-label text-md-right">{{ __('Village') }}</label>

                            <div class="col-md-6">

                                <select name="village_id" class="form-control" id="village_id">
                                    <option value="">Select Village --Optional</option>
                                    @foreach($village as $key => $value)
                                    @if($value->id == $user->village_id_FK)
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
                            <label for="type" class="col-md-4 col-form-label text-md-right">{{ __('Type') }}</label>

                            <div class="col-md-6">
                                <select name="type" class="form-control" id="type">
                                    <option value="">Select Type </option>
                                    <option value="1" @if ($user->type == 1)
                                        selected
                                    @endif>Kisan</option>
                                    <option value="2" @if ($user->type == 2)
                                        selected
                                    @endif>Merchant</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="status" class="col-md-4 col-form-label text-md-right">{{ __('Status') }}</label>

                            <div class="col-md-6">
                                <select name="status" class="form-control" id="status">
                                    <option value="">Select Status </option>
                                    <option value="1" @if ($user->status == 1)
                                        selected
                                    @endif>Active</option>
                                    <option value="2" @if ($user->status == 2)
                                        selected
                                    @endif>Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ 'Submit' }}
                                </button>
                                <a href="{{url('/admin/users')}}" class="btn btn-danger"> {{ 'Cancle' }}</a>
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
            city_id: "required",
            village_id: "required",
            mobile_number:{
              required:true,
              minlength:9,
              maxlength:12,
              number: true
            }
        },
        messages: {
            'name': "Name field is required.",
            'city_id': "City field is required.",
            'village_id': "Village field is required.",
            'mobile_number': {
                required: "Contact number field is required.",
                minlength: "Please input a valid contact nubmer",
                maxlength: "Please input a valid contact nubmer",
                number: "Please input a valid contact nubmer",
            }
        },
        submitHandler: function(form) {
            form.submit();
        }
     });


/*Onchange Ajax call Village*/

$(document).ready(function () {
        $('#city_id').on('change', function () {

        var cityId = this.value;

        $("#village_id").html('');

        $.ajax({
            url: "{{url('admin/fetch-villages')}}",
            type: "GET",
            data: {
                cityId: cityId
            },
            dataType: 'json',
            success: function (result) {
                $('#village_id').html('<option value="">Select Village --Optional</option>');
                $.each(result.villages, function (key, value) {
                    $("#village_id").append('<option value="' + value
                        .id + '">' + value.name + '</option>');
                });
            }
        });
    });    
});
/*Onchange Ajax call Village*/
</script>
@endsection
