<?php

namespace App\Http\Livewire;

use App\Jobs\DeleteAllJob;
use Livewire\Component;

class Delete extends Component
{
    public function delete()
    {
        DeleteAllJob::dispatchSync(request()->user());

        $this->emit('deleted');
    }

    public function render()
    {
        return view('livewire.delete');
    }
}
