@extends('layouts.app')
@section('content')
    <div class="container">
        @include('partial.success')
        <a class="btn btn-success float-right" href="{{ route('currencies.create') }}">Add currency</a>
        <table class="table table-hover">
            <thead>
            <tr>
                <td>Name</td>
                <td>Code</td>
                <td>Symbol</td>
                <td>Default</td>
                <td>Action</td>
            </tr>
            </thead>
            <tbody>

                @foreach($currencies as $currency)
                    <tr>
                        <td>{{ $currency->name }}</td>
                        <td>{{ $currency->code }}</td>
                        <td>{{ $currency->symbol }}</td>
                        <td>
                            @if ($currency->isDefault)
                                <strong>default</strong>
                            @endif
                        </td>
                        <td>
                            <div class="btn-group">
                            <a class="btn btn-success" href="{{ route('currencies.edit', $currency->id) }}">Edit</a>

                            <form method="post" action="{{ route('currencies.destroy', $currency->id) }}">
                                {{ csrf_field() }}
                                {{ method_field('delete') }}
                                <input type="submit" value="Delete" class="btn btn-danger">
                            </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
