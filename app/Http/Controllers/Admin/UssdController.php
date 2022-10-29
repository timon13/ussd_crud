<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyUssdRequest;
use App\Http\Requests\StoreUssdRequest;
use App\Http\Requests\UpdateUssdRequest;
use App\User;
use App\Ussd;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UssdController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('ussd_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ussds = Ussd::with(['users'])->get();

        return view('admin.ussds.index', compact('ussds'));
    }

    public function create()
    {
        abort_if(Gate::denies('ussd_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id');

        return view('admin.ussds.create', compact('users'));
    }

    public function store(StoreUssdRequest $request)
    {
        $ussd = Ussd::create($request->all());
        $ussd->users()->sync($request->input('users', []));

        return redirect()->route('admin.ussds.index');
    }

    public function edit(Ussd $ussd)
    {
        abort_if(Gate::denies('ussd_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id');

        $ussd->load('users');

        return view('admin.ussds.edit', compact('users', 'ussd'));
    }

    public function update(UpdateUssdRequest $request, Ussd $ussd)
    {
        $ussd->update($request->all());
        $ussd->users()->sync($request->input('users', []));

        return redirect()->route('admin.ussds.index');
    }

    public function show(Ussd $ussd)
    {
        abort_if(Gate::denies('ussd_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ussd->load('users', 'ussdUssdMenus');

        return view('admin.ussds.show', compact('ussd'));
    }

    public function destroy(Ussd $ussd)
    {
        abort_if(Gate::denies('ussd_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ussd->delete();

        return back();
    }

    public function massDestroy(MassDestroyUssdRequest $request)
    {
        Ussd::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
