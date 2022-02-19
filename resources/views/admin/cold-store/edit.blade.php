@extends('layouts.base')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ "Edit Cold Store" }}</div>

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
                            <label for="city_id" class="col-md-4 col-form-label text-md-right">{{ __('Select City') }}</label>

                            <div class="col-md-6">

                                <select name="city_id" class="form-control" id="city_id">
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
                            <label for="village_id" class="col-md-4 col-form-label text-md-right">{{ __('Select Village') }}</label>

                            <div class="col-md-6">

                                <select name="village_id" class="form-control" id="village_id">
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
            city_id: "required",
            village_id: "required",
        },
        messages: {
            'name': "Name field is required.",
            'city_id': "City field is required.",
            'village_id': "village field is required.",
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
