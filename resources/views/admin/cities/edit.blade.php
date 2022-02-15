@extends('layouts.base')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ "Edit City" }}</div>

                <div class="card-body">
                    <form method="POST" id="editForm" action="{{ route('admin.update-city') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Country') }}</label>

                            <div class="col-md-6">
                                <select class="form-control @error('country_id') is-invalid @enderror"  name="country_id" id="country_id" >
                                    <option value="">Select Option</option>
                                    @foreach($countries as $country)
                                    <option value="{{ $country->id }}" {{ $city->country_id == $country->id ? "selected" : "" }} >{{ $country->name }}</option>
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
                            <label for="exam_id" class="col-md-4 col-form-label text-md-right">{{ __('State') }}</label>

                            <div class="col-md-6">
                                <select class="form-control @error('state_id') is-invalid @enderror" name="state_id" id="state_id" required>
                                    <option value="">Select Option</option>
                                    @foreach($states as $state)
                                    <option value="{{ $state->id }}" {{ $city->state_id == $state->id ? "selected" : "" }} >{{ $state->name }}</option>
                                    @endforeach
                                </select>

                                @error('exam_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input type='hidden' value="{{ $city->id }}" name="id">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{old('name', $city->name)}}" required >

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

        $("#editForm").validate({
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

        $("#state_id").html('');

        var countryId = this.value;


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
});
</script>
@endsection
