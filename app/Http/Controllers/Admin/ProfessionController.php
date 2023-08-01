<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Message;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProfessionRequest;
use App\Models\Profession;
use App\Models\ProfessionCategory;
use Inertia\Inertia;

class ProfessionController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Profession/Index', [
            'items' => Profession::with('categories', 'tags')->orderBy('created_at')->paginate(9),
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Profession/Create');
    }

    public function store(ProfessionRequest $request)
    {
        $profession = Profession::create($request->validated());

        $ids = array_map(function ($category) {
            return $category['id'];
        }, $request->categories);
        $profession->categories()->sync($ids);

        $ids = array_map(function ($tag) {
            return $tag['id'];
        }, $request->tags);
        $profession->tags()->sync($ids);

        Message::show('Profession created');
        return redirect()->route('admin.profession.index');
    }

    public function edit(Profession $profession)
    {
        $profession->load('image');
        $profession->load('categories');
        $profession->load('tags');
        return Inertia::render('Admin/Profession/Edit', [
            'item' => $profession,
        ]);
    }

    public function update(ProfessionRequest $request, Profession $profession)
    {
        $profession->update($request->validated());

        $ids = array_map(function ($category) {
            return $category['id'];
        }, $request->categories);
        $profession->categories()->sync($ids);

        $ids = array_map(function ($tag) {
            return $tag['id'];
        }, $request->tags);
        $profession->tags()->sync($ids);

        Message::show('Profession updated');
        return redirect()->route('admin.profession.index');
    }

    public function destroy(Profession $profession)
    {
        $profession->delete();
        Message::show('Profession deleted');
        return redirect()->route('admin.profession.index');
    }
}
