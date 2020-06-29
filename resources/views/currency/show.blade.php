@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-d-4">
                <p>Name: {{ $currency->name }}</p>
                <p>Code: {{ $currency->code }}</p>
                <p>Symbol: {{ $currency->symbol }}</p>
                <p>Rate: {{ $currency->rate }}</p>
            </div>
        </div>
    </div>
@endsection
