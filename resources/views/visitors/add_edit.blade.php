@extends('layouts.app')

@push('upper_scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <script src="https://cdn.jsdelivr.net/momentjs/2.14.1/moment.min.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
@endpush

@section('content')
    <div class="container mt-5">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if ($status == 'edit')
        <form action="{{ route('visitor.update', $meeting->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col">
                    <input type="text" name="guest_name" class="form-control" placeholder="Visitor name" aria-label="Visitor name" value="{{ $meeting->guest_name }}">
                </div>
                <div class="col">
                    <input type="email" name="guest_email" class="form-control" placeholder="Visitor email" aria-label="Visitor email" value="{{ $meeting->guest_email }}">
                </div>
            </div>
            <div class="row mt-5">
                <div class="col">
                    <div class='input-group date' id='datetime_start'>
                        <input type='text' name="starts_at" class="form-control"/>
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>
                <div class="col">
                    <div class='input-group date' id='datetime_end'>
                        <input type='text' name="ends_at" class="form-control"/>
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-md-12">
                    <textarea name="comments" rows="2" class="form-control">{{ $meeting->comments }}</textarea>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-md-6">
                    <a href="{{ route('visitor.index') }}" class="btn btn-light">Back</a>
                </div>

                <div class="col-md-6">
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        {{-- <a href="{{ route('visitor.destroy', $meeting) }}" class="btn btn-danger me-md-2">Delete</a> --}}
                        <button class="btn btn-primary" type="submit">Update</a>
                      </div>
                </div>
            </div>
        </form>
        @else
        <form action="{{ route('visitor.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col">
                    <input type="text" name="guest_name" class="form-control" placeholder="Visitor name" aria-label="Visitor name">
                </div>
                <div class="col">
                    <input type="email" name="guest_email" class="form-control" placeholder="Visitor email" aria-label="Visitor email">
                </div>
            </div>
            <div class="row mt-5">
                <div class="col">
                    <div class='input-group date' id='datetime_start'>
                        <input type='text' name="starts_at" class="form-control"/>
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>
                <div class="col">
                    <div class='input-group date' id='datetime_end'>
                        <input type='text' name="ends_at" class="form-control"/>
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-md-12">
                    <textarea name="comments" rows="2" class="form-control"></textarea>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-md-6">
                    <a href="{{ route('visitor.index') }}" class="btn btn-light">Back</a>
                </div>

                <div class="col-md-6">
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button class="btn btn-primary" type="submit">Save</a>
                    </div>
                </div>
            </div>
        </form>
        @endif
    </div>
@endsection

@push('lower_scripts')
    <script>
        $(function () {
            $('#datetime_start').datetimepicker({
                @if($status == 'edit')
                date: '{{ $meeting->starts_at }}',
                @endif
                disabledDates: [new Date()]
            });

            $('#datetime_end').datetimepicker({
                // minDate:new Date(),
                @if($status == 'edit')
                date: '{{ $meeting->ends_at }}',
                @endif
                disabledDates: [new Date()]
            });
        });
    </script>
@endpush
