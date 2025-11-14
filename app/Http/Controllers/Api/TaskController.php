<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Mail\TaskCompletedMail;
use Illuminate\Support\Facades\Mail;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    // GET /api/tasks
    public function index(Request $request)
    {
        $query = Task::where('user_id', $request->user()->id);

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        return response()->json($query->orderBy('due_date')->get());
    }

    // POST /api/tasks
    public function store(StoreTaskRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = $request->user()->id;
        $task = Task::create($data);

        return response()->json($task, 201);
    }

    // PUT/PATCH /api/tasks/{task}
    public function update(UpdateTaskRequest $request, Task $task)
    {
        if ($task->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $oldStatus = $task->status;
        $task->update($request->validated());

        if ($oldStatus !== 'Completed' && $task->status === 'Completed') {
            Mail::to($task->user->email)->queue(new TaskCompletedMail($task));
        }

        return response()->json($task);
    }

    public function destroy(Request $request, Task $task)
    {
        if ($task->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $task->delete();
        return response()->json(['message' => 'Deleted'], 200);
    }
}
