<?php

namespace App\Livewire;

use App\Jobs\DeleteAllJob;
use Livewire\Component;

class Delete extends Component
{
    public function delete(): void
    {
        DeleteAllJob::dispatchSync(request()->user());

        $this->dispatch('deleted');
    }
}
