@extends('layouts.app')

@section('content')
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
            <th scope="row">{{ $member['full_name'] }}</th>
            <td>{{ $member['email_address'] }}</td>
            <td>{{ $member['status'] }}</td>
            <td><a href="{{ route('members.index') }}">Back to list</a></td>
        </tr>
        </tbody>
    </table>
@endsection
