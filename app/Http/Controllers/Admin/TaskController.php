<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Message;
use App\Http\Controllers\Controller;
use App\Http\Requests\TaskFilterRequest;
use App\Http\Requests\TaskRequest;
use App\Models\Task;
use App\Models\WorkDay;
use Inertia\Inertia;

class TaskController extends Controller
{
    public function index(TaskFilterRequest $request)
    {
        $work_day = WorkDay::with('profession')->findOrFail($request->work_day_id);
        return Inertia::render('Admin/Task/Index', [
            'items' => Task::with('image')->where('work_day_id', $work_day->id)->orderBy('created_at')->paginate(9),
            'work_day' => $work_day,
        ]);
    }

    public function create(TaskFilterRequest $request)
    {
        $work_day = WorkDay::findOrFail($request->work_day_id);
        return Inertia::render('Admin/Task/Create', [
            'work_day' => $work_day,
        ]);
    }

    public function store(TaskFilterRequest $filter_request, TaskRequest $form_request)
    {
        $work_day = WorkDay::findOrFail($filter_request->work_day_id);
        $task = Task::create($form_request->validated());
        $task->work_day_id = $work_day->id;
        $task->save();
        Message::show('Task created');
        return redirect()->route('admin.task.index', ['work_day_id' => $work_day->id]);
    }

    public function edit(Task $task)
    {
        $task->load('work_day', 'image');
        return Inertia::render('Admin/Task/Edit', [
            'item' => $task,
        ]);
    }

    public function update(TaskRequest $request, Task $task)
    {
        $task->update($request->validated());
        Message::show('Task updated');
        return redirect()->route('admin.task.index', ['work_day_id' => $task->work_day_id]);
    }

    public function destroy(Task $task)
    {
        $task->delete();
        Message::show('Task deleted');
        return redirect()->route('admin.task.index', ['work_day_id' => $task->work_day_id]);
    }
}
