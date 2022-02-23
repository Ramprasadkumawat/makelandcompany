@extends('layouts.base')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ "Edit Employees" }}</div>

                <div class="card-body">
                    <form method="POST" id="editForm" action="{{ route('admin.update-employees') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input type='hidden' value="{{ $employees->id }}" name="id">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $employees->name) }}" required autocomplete="name" autofocus required>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="per_round_payment" class="col-md-4 col-form-label text-md-right">{{ __('Per Round Payment') }}</label>

                            <div class="col-md-6">
                                <input id="per_round_payment" type="number" class="form-control @error('per_round_payment') is-invalid @enderror" name="per_round_payment" value="{{ old('per_round_payment', $employees->per_round_payment) }}" required autocomplete="per_round_payment" autofocus required>

                                @error('per_round_payment')
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
                                    <option value="1" @if ($employees->status == 1)
                                        selected
                                    @endif>Active</option>
                                    <option value="2" @if ($employees->status == 2)
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
                                <a href="{{url('/admin/employees')}}" class="btn btn-danger"> {{ 'Cancel' }}</a>
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
            per_round_payment: "required",
            status: "required",
        },
        messages: {
            'name': "Name field is required.",
            'per_round_payment': "Per Round Payment field is required.",
            'status': "Status Weight field is required.",
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
