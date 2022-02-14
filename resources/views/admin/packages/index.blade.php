@extends('layouts.base')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="pull-left"> Packages List</div> 
                    <div class="pull-right"> <a href="{{url('/admin/create-package')}}" class="btn btn-md btn-primary"> + Add Package</a> </div> 
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
                          <th scope="col">Critiques</th>
                          <th scope="col">Coins</th>
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
            ajax: "{{ url('admin/get-packages') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'name', name: 'name'},
                {data: 'critiques', name: 'critiques'},
                {data: 'coins', name: 'coins'},
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

            window.location.href = "{{url('admin/delete-package').'/'}}"+id;
        } else { 
            // stop the ajax call
            return false;
        }
    }
</script>
@endsection

