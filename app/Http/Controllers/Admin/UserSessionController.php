<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\UserSession;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserSessionController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('user_session_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userSessions = UserSession::all();

        return view('admin.userSessions.index', compact('userSessions'));
    }

    public function show(UserSession $userSession)
    {
        abort_if(Gate::denies('user_session_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.userSessions.show', compact('userSession'));
    }
}
