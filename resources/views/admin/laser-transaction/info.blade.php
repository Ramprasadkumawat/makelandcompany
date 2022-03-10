@extends('layouts.base')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ "Cold Store Stock Transasction Information" }}</div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif
                    <form >
                        
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
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="type" class="col-md-4 col-form-label text-md-right">{{ __('Transaction Type') }}</label>
                            <div class="col-md-6">
                                <select name="type" class="form-control" id="type" required>
                                    <option value="">Select Transaction </option>
                                    <option value="1">IN</option>
                                    <option value="2">OUT</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <a id="check" href="#" class="btn btn-info"> {{ 'Check' }}</a>
                                <a href="{{url('/admin/')}}" class="btn btn-danger"> {{ 'Back' }}</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-header">{{ "Last 10 Transactions" }}</div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Item name</th>
                                <th scope="col">Maal(50KG Bore Count) </th>
                                <th scope="col">Weight</th>
                                <th scope="col">Transaction Type</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')

<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script type="text/javascript">

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
    
    $("#check").on('click', function () {
        
        let coldStorageStockId = $("#coldstore_stock_id").val();
        let type = $("#type").val();

        $.ajax({
            url: "{{url('admin/get-stock-transactions-list')}}",
            type: "GET",
            data: {
                coldStorageStockId : coldStorageStockId,
                type:type
            },
            dataType: 'json',
            success: function (result) {
                
                let i=1;
                $.each(result.stockTransaction, function (key, value) {
                    let row ='';
                    row +='<tr>';
                    row += '<th scope="row">'+i+'</th>';
                    row += '<td>'+value.item_name+'</td>';
                    row += '<td>'+value.maal+'</td>';
                    row += '<td>'+value.maal_weight+'</td>';
                    row += '<td>'+value.type+'</td>';
                    row +='</tr>';

                    $("table tbody").append(row);
                    i++;
                });
            }
        });
    });
});
/*Onchange Ajax call Cold Store*/
</script>

@endsection
