<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Message;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProfessionCategoryRequest;
use App\Models\ProfessionCategory;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProfessionCategoryController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/ProfessionCategory/Index', [
            'items' => ProfessionCategory::with('professions', 'image')->orderBy('created_at')->paginate(9),
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/ProfessionCategory/Create');
    }

    public function store(ProfessionCategoryRequest $request)
    {
        ProfessionCategory::create($request->validated());
        Message::show('Profession category created');
        return redirect()->route('admin.profession_category.index');
    }

    public function edit(ProfessionCategory $profession_category)
    {
        $profession_category->load('image');
        return Inertia::render('Admin/ProfessionCategory/Edit', [
            'item' => $profession_category,
        ]);
    }

    public function update(ProfessionCategoryRequest $request, ProfessionCategory $profession_category)
    {
        $profession_category->update($request->validated());
        Message::show('Profession category updated');
        return redirect()->route('admin.profession_category.index');
    }

    public function destroy(ProfessionCategory $profession_category)
    {
        $profession_category->delete();
        Message::show('Profession category deleted');
        return redirect()->route('admin.profession_category.index');
    }

    public function selectSearch(Request $request)
    {
        $table_name = with(new ProfessionCategory)->getTable();
        $request->validate([
            'phrase' => ['nullable', 'string'],
            'ids' => ['nullable', 'array'],
            'ids.*' => ['required', 'integer', "exists:$table_name,id"],
        ]);

        return response()->json([
            'items' => ProfessionCategory::select('id', 'name')
                ->when($request->ids, function ($q) use ($request) {
                    $q->whereIn('id', $request->ids);
                })
                ->when($request->phrase, function ($q) use ($request) {
                    $q->orWhereRaw("cast(id as text) like '%".$request->phrase."%'");
                    $q->orWhereRaw("lower(name) like '%".strtolower($request->phrase)."%'");
                })
                ->orderBy('name')->limit(10)->get(),
        ]);
    }
}
