<?php

namespace App\Http\Controllers;

use App\Http\Requests\AttachmentRequest;
use App\Models\Attachment;

class AttachmentController extends Controller
{
    public function store(AttachmentRequest $request)
    {
        $path = $request->file('file')->store('public/attachments');

        $attachment = Attachment::create([
            'user_id' => $request->user()->id,
            'path' => $path,
        ]);

        return response()->json([
            'id' => $attachment->id,
        ]);
    }
}
