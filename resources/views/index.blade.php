@extends('layouts.app')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (session('failure'))
        <div class="alert alert-success">
            {{ session('failure') }}
        </div>
    @endif
    <main class="px-3">
        <h1 class="my-3">List members</h1>
        <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-3">
            <a href="{{ route('newsletters.create') }}" class="btn btn-info me-md-2" type="button">Add member</a>
        </div>
        <table class="table table-success table-striped shadow">
            <thead>
            <tr>
                <th scope="col">Email</th>
                <th scope="col">Subscribed</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($membersCollection as $member)
                <tr>
                    <td>{{ $member['email_address'] }}</td>
                    <td><span class="badge rounded-pill bg-light text-dark">{{ $member['status'] }}</span></td>
                    <td>
                        <a href="{{ route('newsletters.show', $member['email_address'])}}" class="btn btn-outline-info btn-sm"><i class="fas fa-eye"></i></a>
                        <a href="{{ route('newsletters.edit', $member['email_address'])}}" class="btn btn-outline-secondary btn-sm"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('newsletters.destroy',$member['email_address'])}}" method="post" style="display: inline-block">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-outline-danger btn-sm" type="submit"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </main>
@endsection
