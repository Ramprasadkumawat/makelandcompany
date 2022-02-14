@extends('layouts.base')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ "Configuration" }}</div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    <form method="POST" id="createForm" action="{{ route('admin.update.configuration') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="amount_uploading" class="col-md-4 col-form-label text-md-right">{{ __('Amount Uploading') }}</label>

                            <div class="col-md-6">
                                
                                <input type="hidden" name="id" value="{{ $configuration->id }}">
                                <input id="amount_uploading" type="number" class="form-control @error('amount_uploading') is-invalid @enderror" name="amount_uploading" value="{{old('amount_uploading', $configuration->amount_uploading)}}" required min="1" >

                                @error('amount_uploading')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="min_critique_buy" class="col-md-4 col-form-label text-md-right">{{ __('Min Critique Buy') }}</label>

                            <div class="col-md-6">
                                <input id="min_critique_buy" type="number" class="form-control @error('min_critique_buy') is-invalid @enderror" name="min_critique_buy" value="{{old('min_critique_buy', $configuration->min_critique_buy)}}" required min="1">

                                @error('min_critique_buy')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="max_critique_buy" class="col-md-4 col-form-label text-md-right">{{ __('Max Critique Buy') }}</label>

                            <div class="col-md-6">
                                <input id="max_critique_buy" type="number" class="form-control @error('max_critique_buy') is-invalid @enderror" name="max_critique_buy" value="{{old('max_critique_buy', $configuration->max_critique_buy)}}" required min="1">

                                @error('max_critique_buy')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="eligible_nft_creation" class="col-md-4 col-form-label text-md-right">{{ __('Eligible NFT Creation') }}</label>

                            <div class="col-md-6">
                                <input id="eligible_nft_creation" type="number" class="form-control @error('eligible_nft_creation') is-invalid @enderror" name="eligible_nft_creation" value="{{old('eligible_nft_creation', $configuration->eligible_nft_creation)}}" required min="1" >

                                @error('eligible_nft_creation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="percentage_share_nft" class="col-md-4 col-form-label text-md-right">{{ __('Percentage Share NFT') }}</label>

                            <div class="col-md-6">
                                <input id="percentage_share_nft" type="number" class="form-control @error('percentage_share_nft') is-invalid @enderror" name="percentage_share_nft" value="{{old('percentage_share_nft', $configuration->percentage_share_nft)}}" required step="any" min="1">

                                @error('percentage_share_nft')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ 'Submit' }}
                                </button>
                                <a href="{{url('/admin')}}" class="btn btn-danger"> {{ 'Cancle' }}</a>
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
            amount_uploading: "required",
            min_critique_buy: "required",
            max_critique_buy: "required",
            eligible_nft_creation: "required",
            percentage_share_nft: "required",
        },
        messages: {
            'amount_uploading': "Amount Uploading field is required.",
            'min_critique_buy': "Min Critique Buy field is required.",
            'max_critique_buy': "Max Critique Buy field is required.",
            'eligible_nft_creation': "Eligible NFT Creation field is required.",
            'percentage_share_nft': "Percentage Share NFT field is required."
        },
      submitHandler: function(form) {
        form.submit();
      }
    });
</script>

@endsection
