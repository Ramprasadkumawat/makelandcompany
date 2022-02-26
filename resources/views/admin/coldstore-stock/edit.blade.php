@extends('layouts.base')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ "Edit Cold Store Stock" }}</div>

                <div class="card-body">
                    <form method="POST" id="editForm" action="{{ route('admin.update-cold-store-stock') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Cold Store') }}</label>

                            <div class="col-md-6">
                                
                                <select name="coldstore_id" class="form-control" id="">
                                    @foreach ($coldStore as $item)
                                        @if($item->id == $csStock->coldstore_id_FK)
                                        {
                                            <option value="{{$item->id}}" selected>{{$item->name}}</option>
                                        }
                                        @else
                                        {
                                            <option value="{{$item->id}}">{{$item->name}}</option>  
                                        }
                                        @endif
                                    @endforeach
                                </select>

                                @error('coldstore_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input type='hidden' value="{{ $csStock->id }}" name="id">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{old('name', $csStock->name)}}" required autocomplete="name" autofocus>

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
                                <input id="capacity" type="number" class="form-control @error('capacity') is-invalid @enderror" name="capacity" value="{{old('name', $csStock->capacity)}}" required autocomplete="capacity" autofocus required>

                                @error('capacity')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Weight In Quaintal') }}</label>

                            <div class="col-md-6">
                                <input id="weight" type="number" class="form-control @error('weight') is-invalid @enderror" name="weight" value="{{old('name', $csStock->weight)}}" required autocomplete="weight" autofocus required>

                                @error('weight')
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
                                    <option value="1" @if ($csStock->status == 1)
                                        selected
                                    @endif>Active</option>
                                    <option value="2" @if ($csStock->status == 2)
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
                                <a href="{{url('/admin//cold-store-stock')}}" class="btn btn-danger"> {{ 'Cancel' }}</a>
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
            capacity: "required",
            weight: "required",
        },
        messages: {
            'name': "Name field is required.",
            'capacity': "Capacity field is required.",
            'eight': "Capacity Weight field is required.",
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