<?php

namespace App\Http\Livewire;

use App\Jobs\DeleteJob;
use Livewire\Component;

class Delete extends Component
{
    public function delete()
    {
        DeleteJob::dispatchNow(request()->user());

        $this->emit('deleted');
    }

    public function render()
    {
        return view('livewire.delete');
    }
}
