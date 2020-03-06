<?php

namespace App\Http\Controllers;

use App\Jobs\DeleteJob;
use Illuminate\Http\Request;

class DeleteController extends Controller
{
    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function __invoke(Request $request)
    {
        DeleteJob::dispatchNow($request->user());

        return redirect('home');
    }
}
