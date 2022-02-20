@extends('layouts.base')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ "Create Cold Store" }}</div>

                <div class="card-body">
                    <form method="POST" id="createForm" action="{{ route('admin.store-transport-vehicle') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" placeholder="Dhakad Roadlines" autofocus required>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Capacity (Bore count)') }}</label>

                            <div class="col-md-6">
                                <input id="capacity" type="number" class="form-control @error('capacity') is-invalid @enderror" name="capacity" value="{{ old('capacity') }}" required autocomplete="capacity" placeholder="300" autofocus required>

                                @error('capacity')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Capacity (weight)') }}</label>

                            <div class="col-md-6">
                                <input id="capacity_weight" type="number" class="form-control @error('capacity_weight') is-invalid @enderror" name="capacity_weight" value="{{ old('capacity_weight') }}" required autocomplete="capacity_weight" placeholder="3000" autofocus required>

                                @error('capacity_weight')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        

                        <div class="form-group row">
                            <label for="status" class="col-md-4 col-form-label text-md-right">{{ __('Status') }}</label>

                            <div class="col-md-6">
                                <select name="status" class="form-control" id="status" required>
                                    <option value="">Select Status </option>
                                    <option value="1">Active</option>
                                    <option value="2">Inactive</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ 'Submit' }}
                                </button>
                                <a href="{{url('/admin/transport-vehicle')}}" class="btn btn-danger"> {{ 'Cancel' }}</a>
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
            capacity: "required",
            capacity_weight: "required",
        },
        messages: {
            'name': "Name field is required.",
            'capacity': "Capacity field is required.",
            'capacity_weight': "Capacity Weight field is required.",
        },
      submitHandler: function(form) {
        form.submit();
      }
     });

/*Onchange Ajax call Village*/

// $(document).ready(function () {
//         $('#city_id').on('change', function () {

//         var cityId = this.value;

//         $("#village_id").html('');

//         $.ajax({
//             url: "{{url('admin/fetch-villages')}}",
//             type: "GET",
//             data: {
//                 cityId: cityId
//             },
//             dataType: 'json',
//             success: function (result) {
//                 $('#village_id').html('<option value="">Select Village --Optional</option>');
//                 $.each(result.villages, function (key, value) {
//                     $("#village_id").append('<option value="' + value
//                         .id + '">' + value.name + '</option>');
//                 });
//             }
//         });
//     });    
// });
/*Onchange Ajax call Village*/
</script>

@endsection
