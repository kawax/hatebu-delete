<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConfigController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function edit()
    {
        return view('config.edit');
    }

    /**
     * @param  Request  $request
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
