<?php

namespace App\Http\Controllers;

use App\Jobs\DeleteOneJob;
use Illuminate\Http\Request;

class DeleteOneController extends Controller
{
    /**
     * 個別削除.
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
