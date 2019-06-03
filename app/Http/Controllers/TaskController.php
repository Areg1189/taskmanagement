<?php

namespace App\Http\Controllers;

use App\Contracts\TaskInterface;
use App\Http\Requests\TaskRequest;
use App\Models\Task;
use App\User;
use foo\bar;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    protected $task;


    public function __construct(TaskInterface $task)
    {
        $this->task = $task;
    }


    public function index(Request $request)
    {
        $data = $this->task->index($request->all(), auth()->user());
        $data->appends([
            'status' => $request->status,
            'page' => $request->page??1,
            ]);
        return view('task.index', compact('data'));
    }

    public function create(Request $request, Task $task)
    {
        $this->authorize('create', Task::class);
        if (!$request->ajax()) return abort(403);
        $html = view('task.edit-add', compact('task'))->render();

        return response()->json(['html' => $html]);
    }

    public function store(TaskRequest $request, Task $task)
    {
        if ($request->ajax()) return response()->json(['errors' => false]);
        $this->task->store($request->except('_token'), $task, auth()->user());
        return back()->with([
            'alert-type' => 'success',
            'message' => 'Task successfully created'
        ]);
    }

    public function edit(Request $request, Task $task)
    {
        $this->authorize('edit', $task);
        if (!$request->ajax()) return abort(403);
        $html = view('task.edit-add', compact('task'))->render();
        return response()->json(['html' => $html]);
    }

    public function update(TaskRequest $request, Task $task)
    {
        $this->authorize('edit', $task);
        if ($request->ajax()) return response()->json(['errors' => false]);
        $this->task->update($request->except('_token'), $task, auth()->user());
        return back()->with([
            'alert-type' => 'success',
            'message' => 'Task successfully updated'
        ]);
    }

    public function view(Request $request, Task $task)
    {

        if (!$request->ajax()) return abort(403);
        $html = view('task.view', compact('task'))->render();
        return response()->json(['html' => $html]);
    }

    public function getDevelopers(Request $request)
    {
        $search = trim($request->search);
        $data = User::select('id', 'name as text')->getDevelopers($search)->get()->toArray();
        return response()->json($data);
    }

    public function changeStatus(Request $request, Task $task)
    {
        $this->authorize('changeStatus', $task);
        if ($request->ajax()) {
            $task->status = $request->status;
            $task->save();
            return response()->json(['message' => 'Task status successfully updated']);
        } else {
            return abort(403);
        }
    }
}
