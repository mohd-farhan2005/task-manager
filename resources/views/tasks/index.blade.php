@extends('layouts.app')

@section('content')
<h2>Tasks</h2>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<a href="{{ route('tasks.create') }}" class="btn btn-primary mb-3">Add Task</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Title</th>
            <th>Status</th>
            <th>Due</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($tasks as $task)
        <tr>
            <td>{{ $task->title }}</td>
            <td>{{ $task->status }}</td>
            <td>{{ $task->due_date ?? 'N/A' }}</td>
            <td>
                <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-sm btn-warning">Edit</a>

                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="d-inline">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger" onclick="return confirm('Delete?')">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection
