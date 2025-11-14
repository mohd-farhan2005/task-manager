@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create Task</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach($errors->all() as $e) <li>{{ $e }}</li> @endforeach</ul>
        </div>
    @endif

    <form action="{{ route('tasks.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Title</label>
            <input name="title" value="{{ old('title') }}" class="form-control" required maxlength="255">
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control">{{ old('description') }}</textarea>
        </div>

        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-select">
                <option value="Pending">Pending</option>
                <option value="In Progress">In Progress</option>
                <option value="Completed">Completed</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Due Date</label>
            <input name="due_date" type="date" value="{{ old('due_date') }}" class="form-control">
        </div>

        <button class="btn btn-primary">Save</button>
    </form>
</div>
@endsection
