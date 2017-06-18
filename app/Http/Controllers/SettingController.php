<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        return view('users.setting');
    }

    public function store(Request $request)
    {
        //$settings = array_merge(user()->settings,array_only($request->all(),['city','bio']));

        //user()->update(['settings' => $settings]);
        user()->settings()->merge($request->all());
        flash('更新资料成功','success')->important();
        return back();
    }
}
