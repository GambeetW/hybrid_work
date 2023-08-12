@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        {{-- @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif --}}

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif

        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a href="{{ route('visitor.create') }}" class="btn btn-primary">Add new visitor</a>
        </div>

        <table class="table table-striped">
            <thead>
            <tr>
                {{-- <th scope="col" width="1%">#</th> --}}
                <th scope="col" width="15%">Visitor name</th>
                <th scope="col">Visitor email</th>
                <th scope="col">Meeting starts at</th>
                <th scope="col">Meeting ends at</th>
                <th scope="col">User created at</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
                @forelse($visitors as $visitor)
                    <tr>
                        {{-- <th scope="row">{{ $visitor->id }}</th> --}}
                        <td><a href="{{ route('visitor.show', $visitor->id) }}">{{ $visitor->guest_name }}</a></td>
                        <td>{{ $visitor->guest_email }}</td>
                        <td>{{ $visitor->starts_at }}</td>
                        <td>{{ $visitor->ends_at }}</td>
                        <td>{{ $visitor->created_at }}</td>
                        <td>
                            <form action="{{ route('visitor.destroy', $visitor->id) }}" method="POST">
                                @csrf

                                @method('DELETE')

                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">There are no users.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="d-flex">
            {{-- {!! $visitors->links() !!} --}}
            {!! $visitors->withQueryString()->links('pagination::bootstrap-5') !!}
        </div>
    </div>
@endsection
