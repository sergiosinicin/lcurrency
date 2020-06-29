@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <form method="post" action="{{ route('currencies.update', $currency->id) }}">
                    {{ csrf_field() }}
                    {{ method_field('put') }}
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" class="form-control" value="{{ $currency->name }}">
                    </div>
                    <div class="form-group">
                        <label for="code">Code</label>
                        <input type="text" id="code" name="code" class="form-control" value="{{ $currency->code }}">
                    </div>
                    <div class="form-group">
                        <label for="symbol">Symbol</label>
                        <input type="text" id="code" name="symbol" class="form-control" value="{{ $currency->symbol }}">
                    </div>
                    @if($canBeSetAsDefault ?? '')
                    <div class="form-group">
                        <input @if($currency->isDefault) checked="checked" @endif type="checkbox" id="isDefault" name="isDefault" class="form-check-input" value="1">
                        <label class="form-check-label" for="isDefault">Is default</label>
                    </div>
                    @endif
                    <input type="submit" value="Submit" class="btn btn-success">
                </form>
            </div>
        </div>
    </div>
@endsection
