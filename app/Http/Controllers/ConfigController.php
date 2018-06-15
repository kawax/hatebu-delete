<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Forms\ConfigForm;

class ConfigController extends Controller
{
    /**
     * @param ConfigForm $form
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(ConfigForm $form)
    {
        return view('config.edit')->with(compact('form'));
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $request->user()->fill($request->only([
            'key',
        ]))->save();

        return back()->with('success', '保存しました。');
    }
}
