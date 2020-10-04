<?php

namespace App\Http\Livewire;

use App\Jobs\DeleteOneJob;
use Livewire\Component;

class Entry extends Component
{
    public $link;
    public $title;
    public $description;
    public $date;

    public function delete()
    {
        DeleteOneJob::dispatchNow(request()->user(), $this->link);

        $this->emit('deleted');
    }

    public function render()
    {
        return view('livewire.entry');
    }
}
