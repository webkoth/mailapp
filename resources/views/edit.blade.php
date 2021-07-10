@extends('layouts.app')

@section('content')
    <a class="btn btn-outline-primary my-4" href="{{ route('newsletters.index') }}"><i class="fas fa-arrow-left"></i></a>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th scope="col">Full Name:</th>
            <th scope="col">Email:</th>
            <th scope="col">Status:</th>
            <th scope="col">Action:</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <form method="post" action="{{ route('newsletters.update', $member['email_address']) }}" style="display: inline-block">
                @csrf
                @method('PUT')
                <th scope="row">
                    <input name="full_name" type="text" class="form-control" value="{{ $member['full_name'] }}">
                </th>
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
