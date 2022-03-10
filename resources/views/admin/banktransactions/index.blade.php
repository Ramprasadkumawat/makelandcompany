@extends('layouts.base')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <!-- <div class="pull-left"> Bank Transactions List</div> -->
                    <select name="cars" id="cars">
                        <option value="volvo">Bank Transactions</option>
                        <option value="saab">Mazdur (Employees) Transactions</option>
                        <option value="mercedes">Stock Transactions</option>
                        <option value="audi">Cold-store Transactions</option>
                    </select> 
                    <div class="pull-right"> <a href="{{url('/admin/banks')}}" class="btn btn-md btn-primary">Banks</a> </div> 
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
                          <th scope="col">Leaser Name</th>
                          <th scope="col">Cold-Store Name</th>
                          <th scope="col">Bank Name</th>
                          <th scope="col">Amount</th>
                          <th scope="col">Status</th>
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
            ajax: "{{ url('admin/get-bank-transactions') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'laser_id_FK', name: 'laser_id_FK'},
                {data: 'coldstore_transaction_id_FK', name: 'coldstore_transaction_id_FK'},
                {data: 'bank_id_FK', name: 'bank_id_FK'},
                {data: 'amount', name: 'amount'},
                {data: 'status', name: 'status'},
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

            window.location.href = "{{url('admin/delete-bank').'/'}}"+id;
        } else { 
            // stop the ajax call
            return false;
        }
    }
</script>
@endsection

