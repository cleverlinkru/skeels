<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Message;
use App\Http\Controllers\Controller;
use App\Http\Requests\WorkDayFilterRequest;
use App\Http\Requests\WorkDayRequest;
use App\Models\Profession;
use App\Models\WorkDay;
use Inertia\Inertia;

class WorkDayController extends Controller
{
    public function index(WorkDayFilterRequest $request)
    {
        $profession = Profession::findOrFail($request->profession_id);
        return Inertia::render('Admin/WorkDay/Index', [
            'items' => WorkDay::where('profession_id', $profession->id)->orderBy('created_at')->paginate(9),
            'profession' => $profession,
        ]);
    }

    public function create(WorkDayFilterRequest $request)
    {
        $profession = Profession::findOrFail($request->profession_id);
        return Inertia::render('Admin/WorkDay/Create', [
            'profession' => $profession,
        ]);
    }

    public function store(WorkDayFilterRequest $filter_request, WorkDayRequest $form_request)
    {
        $profession = Profession::findOrFail($filter_request->profession_id);
        $work_day = WorkDay::create($form_request->validated());
        $work_day->profession_id = $profession->id;
        $work_day->save();
        Message::show('Work day created');
        return redirect()->route('admin.work_day.index', ['profession_id' => $profession->id]);
    }

    public function edit(WorkDay $work_day)
    {
        $work_day->load('profession');
        return Inertia::render('Admin/WorkDay/Edit', [
            'item' => $work_day,
        ]);
    }

    public function update(WorkDayRequest $request, WorkDay $work_day)
    {
        $work_day->update($request->validated());
        Message::show('Work day updated');
        return redirect()->route('admin.work_day.index', ['profession_id' => $work_day->profession_id]);
    }

    public function destroy(WorkDay $work_day)
    {
        $work_day->delete();
        Message::show('Work day deleted');
        return redirect()->route('admin.work_day.index', ['profession_id' => $work_day->profession_id]);
    }
}
