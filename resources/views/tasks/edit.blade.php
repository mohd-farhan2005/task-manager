@extends('layouts.app')

@section('content')
<h2>Edit Task</h2>

<form method="POST" action="{{ route('tasks.update', $task->id) }}">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Title</label>
        <input name="title" class="form-control" value="{{ $task->title }}" required>
    </div>

    <div class="mb-3">
        <label>Description</label>
        <textarea name="description" class="form-control">{{ $task->description }}</textarea>
    </div>

    <div class="mb-3">
        <label>Status</label>
        <select name="status" class="form-select">
            <option {{ $task->status=='Pending'?'selected':'' }}>Pending</option>
            <option {{ $task->status=='In Progress'?'selected':'' }}>In Progress</option>
            <option {{ $task->status=='Completed'?'selected':'' }}>Completed</option>
        </select>
    </div>

    <div class="mb-3">
        <label>Due Date</label>
        <input type="date" name="due_date" class="form-control" value="{{ $task->due_date }}">
    </div>

    <button class="btn btn-primary">Update</button>
</form>

@endsection
