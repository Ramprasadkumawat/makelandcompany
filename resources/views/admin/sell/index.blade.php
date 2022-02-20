@extends('layouts.base')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="pull-left"> Sell List</div> 
                    <div class="pull-right"> <a href="{{url('/admin/create-sell-and-store')}}" class="btn btn-md btn-primary"> + Add Sell</a> </div> 
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif


                    <table class="table" id="artists-table">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Customer Name</th>
                          <th scope="col">Cold-Store Name</th>
                          <th scope="col">Stock Name</th>
                          <th scope="col">Product Name</th>
                          <!-- <th scope="col">Type</th>
                          <th scope="col">City</th>
                          <th scope="col">Village</th>
                          <th scope="col">Amount</th> -->
                          <th scope="col">Date & Time</th>
                          <th scope="col">Edit</th>
                          <th scope="col">Delete</th>
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
<script>
    $(function() {
        
        $('#artists-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ url('admin/get-sells') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'customername', name: 'customername'},
                {data: 'storename', name: 'storename'},
                {data: 'stockname', name: 'stockname'},
                {data: 'productname', name: 'productname'},
                // {data: 'type', name: 'type'},
                // {data: 'cityname', name: 'cityname'},
                // {data: 'villagename', name: 'villagename'},
                // {data: 'amount', name: 'amount'},
                {data: 'created_at', name: 'created_at'},
                {data: 'edit', name: 'edit', orderable: false, searchable: false},
                {data: 'delete', name: 'delete', orderable: false, searchable: false},
            ]
        });
    });

    function deleteArtist(id) {

        if(confirm("Are you sure want to delete ?")){
            // do something
            /*$.ajax({
               type:'POST',
               url:'/getmsg',
               //data:'_token = <?php echo csrf_token() ?>',

               data:'_token = <?php echo csrf_token() ?>',
               success:function(data) {
                  $("#msg").html(data.msg);
               }
            });*/

            window.location.href = "{{url('admin/delete-sell-and-store').'/'}}"+id;
        } else { 
            // stop the ajax call
            return false;
        }
    }
</script>
@endsection

