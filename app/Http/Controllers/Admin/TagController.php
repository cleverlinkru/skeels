<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TagRequest;
use App\Models\Tag;
use Inertia\Inertia;
use App\Helpers\Message;

class TagController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Tag/Index', [
            'items' => Tag::orderBy('created_at')->paginate(9),
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Tag/Create');
    }

    public function store(TagRequest $request)
    {
        Tag::create($request->validated());
        Message::show('Tag created');
        return redirect()->route('admin.tag.index');
    }

    public function edit(Tag $tag)
    {
        return Inertia::render('Admin/Tag/Edit', [
            'item' => $tag,
        ]);
    }

    public function update(TagRequest $request, Tag $tag)
    {
        $tag->update($request->validated());
        Message::show('Tag updated');
        return redirect()->route('admin.tag.index');
    }

    public function destroy(Tag $tag)
    {
        $tag->delete();
        Message::show('Tag deleted');
        return redirect()->route('admin.tag.index');
    }

    public function selectSearch(Request $request)
    {
        $table_name = with(new Tag)->getTable();
        $request->validate([
            'phrase' => ['nullable', 'string'],
            'ids' => ['nullable', 'array'],
            'ids.*' => ['required', 'integer', "exists:$table_name,id"],
        ]);

        return response()->json([
            'items' => Tag::select('id', 'name')
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
