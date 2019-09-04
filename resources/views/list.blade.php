@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>Habit List</div>
                    <div>
                        <a href="/create" class="btn btn-outline-primary">
                            <span class="font-weight-bold">+</span> New Habit
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if ($habits)
                        <div class="list-group">
                            @foreach ($habits as $habit)
                                <a href="/edit/{{ $habit->id }}" class="list-group-item list-group-item-action">
                                    <h6>{{ $habit->title }}</h6>
                                    <p>{{ $habit->repeat_type->description }}</p>
                                </a>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
