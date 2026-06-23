<?php

namespace App\Http\Controllers;

use App\Models\Request;
use App\Models\Task;
use App\Models\Attachment;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->is_admin) {
            return $this->adminDashboard();
        } else {
            return $this->userDashboard();
        }
    }

    private function adminDashboard()
    {
        $pendingRequests = Request::where('status', 'pending')->count();
        $totalRequests = Request::count();
        $totalUsers = \App\Models\User::where('is_admin', false)->count();
        $recentRequests = Request::with('user')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('dashboard.admin', compact(
            'pendingRequests',
            'totalRequests',
            'totalUsers',
            'recentRequests'
        ));
    }

    private function userDashboard()
    {
        $user = Auth::user();

        $myRequests = Request::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        $myTasks = Task::orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        $requestsCount = Request::where('user_id', $user->id)->count();
        $pendingCount = Request::where('user_id', $user->id)
            ->where('status', 'pending')
            ->count();
        $approvedCount = Request::where('user_id', $user->id)
            ->where('status', 'approved')
            ->count();

        return view('dashboard.user', compact(
            'myRequests',
            'myTasks',
            'requestsCount',
            'pendingCount',
            'approvedCount'
        ));
    }
}
