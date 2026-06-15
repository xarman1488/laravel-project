<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use App\Services\AttachmentService;
use Illuminate\Http\Request;

class AttachmentController extends Controller
{
    protected AttachmentService $attachmentService;

    public function __construct(AttachmentService $attachmentService)
    {
        $this->attachmentService = $attachmentService;
    }

    public function index()
    {
        $attachments = Attachment::all();
        return view('attachments.index', compact('attachments'));
    }

    public function create()
    {
        return view('attachments.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'file_name' => 'required|string|max:255',
            'file_path' => 'required|string',
            'file_size' => 'nullable|integer',
            'mime_type' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        Attachment::create($validated);

        return redirect()->route('attachments.index')->with('success', 'Документ сохранен!');
    }

    public function show(Attachment $attachment)
    {
        return view('attachments.show', compact('attachment'));
    }

    public function edit(Attachment $attachment)
    {
        return view('attachments.edit', compact('attachment'));
    }

    public function update(Request $request, Attachment $attachment)
    {
        $validated = $request->validate([
            'file_name' => 'required|string|max:255',
            'file_path' => 'required|string',
            'file_size' => 'nullable|integer',
            'mime_type' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        $attachment->update($validated);

        return redirect()->route('attachments.index')->with('success', 'Информация обновлена!');
    }

    public function destroy(Attachment $attachment)
    {
        $attachment->delete();

        return redirect()->route('attachments.index')->with('success', 'Документ удален!');
    }
}

