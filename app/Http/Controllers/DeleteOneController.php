<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Jobs\DeleteOneJob;


class DeleteOneController extends Controller
{
    /**
     * 個別削除
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(Request $request)
    {
        DeleteOneJob::dispatchNow($request->user(), $request->input('url'));

        return back();
    }
}
