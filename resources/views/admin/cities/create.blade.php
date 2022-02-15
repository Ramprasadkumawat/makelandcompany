@extends('layouts.base')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ "Create City" }}</div>

                <div class="card-body">
                    <form method="POST" id="createForm" action="{{ route('admin.store-city') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Country') }}</label>

                            <div class="col-md-6">
                                <select class="form-control @error('country_id') is-invalid @enderror" name="country_id" id="country_id" required>
                                    <option value="">Select Option</option>
                                    @foreach($countries as $country)
                                    <option value="{{ $country->id }}" {{ old('country_id') == $country->id ? "selected" : "" }} >{{ $country->name }}</option>
                                    @endforeach
                                </select>

                                @error('country_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="state_id" class="col-md-4 col-form-label text-md-right">{{ __('State') }}</label>

                            <div class="col-md-6">
                                <select class="form-control @error('state_id') is-invalid @enderror" name="state_id" id="state_id" required>
                                    <option value="">Select Option</option>
                                </select>

                                @error('state_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required >

                                @error('name')
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
                                <a href="{{url('/admin/cities')}}" class="btn btn-danger"> {{ 'Cancel' }}</a>
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

<script src="{{ asset('public/js/jquery.validate.min.js') }}"></script>

<script type="text/javascript">
    $(document).ready(function () {

    jQuery.validator.addMethod("lettersonly", function(value, element) {

      return this.optional(element) || /^[a-zA-Z\s]+$/i.test(value);
    }, "Please enter valid name");

    $("#createForm").validate({
        rules: {
            country_id: "required",
            name: { lettersonly: true },
        },
        messages: {
            'country_id': "Country field is required.",
            'name': "Please enter valid name",
        },
      submitHandler: function(form) {
        form.submit();
      }
     });
    });
/*Onchange Ajax call genre_id*/

 $(document).ready(function () {
        $('#country_id').on('change', function () {

        var countryId = this.value;

        $("#state_id").html('');

        $.ajax({
            url: "{{url('admin/fetch-states')}}",
            type: "GET",
            data: {
                countryId: countryId
            },
            dataType: 'json',
            success: function (result) {
                $('#state_id').html('<option value="">Select State</option>');
                $.each(result.states, function (key, value) {
                    $("#state_id").append('<option value="' + value
                        .id + '">' + value.name + '</option>');
                });
            }
        });
    });    

            /*$('#country-dd').on('change', function () {
                var idCountry = this.value;
                $("#state-dd").html('');
                $.ajax({
                    url: "{{url('api/fetch-states')}}",
                    type: "POST",
                    data: {
                        country_id: idCountry,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (result) {
                        $('#state-dd').html('<option value="">Select State</option>');
                        $.each(result.states, function (key, value) {
                            $("#state-dd").append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });
                        $('#city-dd').html('<option value="">Select City</option>');
                    }
                });
            });
            $('#state-dd').on('change', function () {
                var idState = this.value;
                $("#city-dd").html('');
                $.ajax({
                    url: "{{url('api/fetch-cities')}}",
                    type: "POST",
                    data: {
                        state_id: idState,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (res) {
                        $('#city-dd').html('<option value="">Select City</option>');
                        $.each(res.cities, function (key, value) {
                            $("#city-dd").append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });
                    }
                });
            });*/
    });
/*Onchange Ajax call genre_id*/
</script>
@endsection
