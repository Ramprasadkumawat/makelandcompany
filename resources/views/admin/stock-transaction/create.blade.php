@extends('layouts.base')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ "Create Cold Store Stock Transasction" }}</div>

                <div class="card-body">
                    <form method="POST" id="createForm" action="{{ route('admin.store-cold-store-stock-transaction') }}">
                        @csrf
                        
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Cold Store') }}</label>

                            <div class="col-md-6">
                                <select name="coldstore_id" class="form-control" id="coldstore_id">
                                    @foreach ($coldStore as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
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
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Cold Store Stock') }}</label>

                            <div class="col-md-6">
                                <select name="coldstore_stock_id" class="form-control" id="coldstore_stock_id">
                                    
                                </select>

                                @error('coldstore_stock_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

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
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Weight In Quaintal') }}</label>

                            <div class="col-md-6">
                                <input id="weight" type="number" class="form-control @error('weight') is-invalid @enderror" name="weight" value="{{ old('weight') }}" required autocomplete="weight" placeholder="3000" autofocus required>

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
                                <a href="{{url('/admin/cold-store-stock')}}" class="btn btn-danger"> {{ 'Cancel' }}</a>
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
            weight: "required",
        },
        messages: {
            'name': "Name field is required.",
            'capacity': "Capacity field is required.",
            'weight': "Weight field is required.",
        },
      submitHandler: function(form) {
        form.submit();
      }
    });

/*Onchange Ajax call Cold Store*/

$(document).ready(function () {
        $('#coldstore_id').on('change', function () {

        var coldStoreId = this.value;

        $("#coldstore_stock_id").html('');

        $.ajax({
            url: "{{url('admin/fetch-coldstore-stocks')}}",
            type: "GET",
            data: {
                coldStoreId: coldStoreId
            },
            dataType: 'json',
            success: function (result) {
                $('#coldstore_stock_id').html('<option value="">Select Coldstore Stock</option>');
                $.each(result.coldStoreStocks, function (key, value) {
                    $("#coldstore_stock_id").append('<option value="' + value
                        .id + '">' + value.name + '</option>');
                });
            }
        });
    });    
});
/*Onchange Ajax call Cold Store*/
</script>

@endsection
