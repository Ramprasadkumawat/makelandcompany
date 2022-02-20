@extends('layouts.base')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ "Edit Bank" }}</div>

                <div class="card-body">
                    <form method="POST" id="editForm" action="{{ route('admin.update-bank') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input type='hidden' value="{{ $bank->id }}" name="id">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{old('name', $bank->name)}}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="status" class="col-md-4 col-form-label text-md-right">{{ __('Status') }}</label>

                            <div class="col-md-6">
                                <select name="status" class="form-control" id="status">
                                    <option value="">Select Status </option>
                                    <option value="1" @if ($bank->status == 1)
                                        selected
                                    @endif>Active</option>
                                    <option value="2" @if ($bank->status == 2)
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
                                <a href="{{url('/admin/banks')}}" class="btn btn-danger"> {{ 'Cancle' }}</a>
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
        },
        messages: {
            'name': "Name field is required.",
        },
        submitHandler: function(form) {
            form.submit();
        }
     });
</script>
@endsection
