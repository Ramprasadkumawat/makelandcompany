@extends('layouts.base')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="pull-left"> Transport-Vehicle List</div> 
                    <div class="pull-right"> <a href="{{url('/admin/create-transport-vehicle')}}" class="btn btn-md btn-primary"> + Add Transport-Vehicle</a> </div> 
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
                          <th scope="col">Name</th>
                          <th scope="col">Capacity(Bore Count)</th>
                          <th scope="col">Capacity Weight</th>
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
            ajax: "{{ url('admin/get-transportvehicles') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'name', name: 'name'},
                {data: 'capacity', name: 'capacity'},
                {data: 'capacity_weight', name: 'capacity_weight'},
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

            window.location.href = "{{url('admin/delete-transport-vehicle').'/'}}"+id;
        } else { 
            // stop the ajax call
            return false;
        }
    }
</script>
@endsection

