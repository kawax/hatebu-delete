<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ConfigController extends Controller
{
    public function edit(): View
    {
        return view('config.edit');
    }

    public function update(Request $request): RedirectResponse
    {
        $request->user()->fill($request->only([
            'key',
        ]))->save();

        return back()->with('success', '保存しました。');
    }
}
