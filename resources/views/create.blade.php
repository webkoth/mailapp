@extends('layouts.app')


@section('content')

    <div class="row">
        <div class="col-md-4 mt-3">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('failure'))
                <div class="alert alert-danger">
                    {{ session('failure') }}
                </div>
            @endif
            <h2>Laravel Newsletter</h2>
            <a class="btn btn-outline-primary my-4" href="{{ route('newsletters.index') }}"><i class="fas fa-arrow-left"></i></a>
            <form method="POST" action="{{ route('newsletters.store') }}">
                @csrf
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp">
                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection
