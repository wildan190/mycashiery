<?php

namespace App\Http\Controllers;

use App\Models\UserLog;

class UserLogController extends Controller
{
    public function index()
    {
        $logs = UserLog::with('user')->orderBy('created_at', 'desc')->paginate(20);

        return view('logs.index', compact('logs'));
    }
}
