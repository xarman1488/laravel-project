<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Request;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request as HttpRequest;

class AdminRequestController extends Controller
{
    public function index()
    {
        $requests = Request::where('status', 'pending')
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.requests.index', compact('requests'));
    }

    public function show($id)
    {
        $request = Request::with(['user', 'comments.user'])->findOrFail($id);

        return view('admin.requests.show', compact('request'));
    }

    public function updateStatus(HttpRequest $httpRequest, $id)
    {
        $request = Request::findOrFail($id);

        $validated = $httpRequest->validate([
            'status' => 'required|in:pending,approved,rejected',
        ]);

        $request->update(['status' => $validated['status']]);

        return redirect()->route('admin.requests.show', $id)
            ->with('success', 'Статус запроса обновлен!');
    }

    public function storeComment(HttpRequest $httpRequest, $id)
    {
        $request = Request::findOrFail($id);

        $validated = $httpRequest->validate([
            'content' => 'required|string|min:3',
        ]);

        Comment::create([
            'request_id' => $request->id,
            'user_id' => auth()->id(),
            'content' => $validated['content'],
        ]);

        return redirect()->route('admin.requests.show', $id)
            ->with('success', 'Комментарий добавлен!');
    }

    public function showUser($userId)
    {
        $user = User::with(['requests.comments'])->findOrFail($userId);

        $requests = $user->requests()
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.users.show', compact('user', 'requests'));
    }
}
