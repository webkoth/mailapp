@extends('layouts.app')

@section('content')
    <a class="btn btn-outline-primary my-4" href="{{ route('members.index') }}"><i class="fas fa-arrow-left"></i></a>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <table class="table table-bordered">
        <thead>
        <tr>
            <th scope="col">Email:</th>
            <th scope="col">Status:</th>
            <th scope="col">Action:</th>
        </tr>
        </thead>
        <tbody>
        <tr>

            <form method="post" action="{{ route('members.update', $member['email_address']) }}" style="display: inline-block">
                @csrf
                @method('PUT')
                <td>
                    <input name="email_address" type="email" class="form-control" value="{{ $member['email_address'] }}">
                </td>
                <td>{{ $member['status'] }}</td>
                <td><button class="btn btn-info" type="submit">Update</button></td>
            </form>
        </tr>
        </tbody>
    </table>
@endsection
