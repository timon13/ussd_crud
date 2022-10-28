<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyUssdMenuRequest;
use App\Http\Requests\StoreUssdMenuRequest;
use App\Http\Requests\UpdateUssdMenuRequest;
use App\Ussd;
use App\UssdMenu;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class UssdMenuController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('ussd_menu_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ussdMenus = UssdMenu::with(['ussd', 'media'])->get();

        return view('admin.ussdMenus.index', compact('ussdMenus'));
    }

    public function create()
    {
        abort_if(Gate::denies('ussd_menu_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ussds = Ussd::pluck('ussd_code', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.ussdMenus.create', compact('ussds'));
    }

    public function store(StoreUssdMenuRequest $request)
    {
        $ussdMenu = UssdMenu::create($request->all());

        if ($request->input('main_menu', false)) {
            $ussdMenu->addMedia(storage_path('tmp/uploads/' . basename($request->input('main_menu'))))->toMediaCollection('main_menu');
        }

        if ($request->input('initiate_request', false)) {
            $ussdMenu->addMedia(storage_path('tmp/uploads/' . basename($request->input('initiate_request'))))->toMediaCollection('initiate_request');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $ussdMenu->id]);
        }

        return redirect()->route('admin.ussd-menus.index');
    }

    public function edit(UssdMenu $ussdMenu)
    {
        abort_if(Gate::denies('ussd_menu_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ussds = Ussd::pluck('ussd_code', 'id')->prepend(trans('global.pleaseSelect'), '');

        $ussdMenu->load('ussd');

        return view('admin.ussdMenus.edit', compact('ussdMenu', 'ussds'));
    }

    public function update(UpdateUssdMenuRequest $request, UssdMenu $ussdMenu)
    {
        $ussdMenu->update($request->all());

        if ($request->input('main_menu', false)) {
            if (!$ussdMenu->main_menu || $request->input('main_menu') !== $ussdMenu->main_menu->file_name) {
                if ($ussdMenu->main_menu) {
                    $ussdMenu->main_menu->delete();
                }
                $ussdMenu->addMedia(storage_path('tmp/uploads/' . basename($request->input('main_menu'))))->toMediaCollection('main_menu');
            }
        } elseif ($ussdMenu->main_menu) {
            $ussdMenu->main_menu->delete();
        }

        if ($request->input('initiate_request', false)) {
            if (!$ussdMenu->initiate_request || $request->input('initiate_request') !== $ussdMenu->initiate_request->file_name) {
                if ($ussdMenu->initiate_request) {
                    $ussdMenu->initiate_request->delete();
                }
                $ussdMenu->addMedia(storage_path('tmp/uploads/' . basename($request->input('initiate_request'))))->toMediaCollection('initiate_request');
            }
        } elseif ($ussdMenu->initiate_request) {
            $ussdMenu->initiate_request->delete();
        }

        return redirect()->route('admin.ussd-menus.index');
    }

    public function show(UssdMenu $ussdMenu)
    {
        abort_if(Gate::denies('ussd_menu_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ussdMenu->load('ussd');

        return view('admin.ussdMenus.show', compact('ussdMenu'));
    }

    public function destroy(UssdMenu $ussdMenu)
    {
        abort_if(Gate::denies('ussd_menu_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ussdMenu->delete();

        return back();
    }

    public function massDestroy(MassDestroyUssdMenuRequest $request)
    {
        UssdMenu::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('ussd_menu_create') && Gate::denies('ussd_menu_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new UssdMenu();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
