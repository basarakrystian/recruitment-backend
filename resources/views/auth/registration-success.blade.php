@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                <div class="card-header">Registration Success</div>

                    <div class="card-body">
                        <p>Your registration was successful. Here is your API token:</p>
                        <code>{{ $token }}</code>

                        <div class="mt-3 d-block">
                            <a href="{{ route('books.index') }}" class="btn btn-primary">Continue</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
