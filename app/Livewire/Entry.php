<?php

namespace App\Livewire;

use App\Jobs\DeleteOneJob;
use Livewire\Component;

class Entry extends Component
{
    public string $link;
    public string $title;
    public string $description;
    public string $date;

    public function delete(): void
    {
        DeleteOneJob::dispatchSync(request()->user(), $this->link);

        $this->dispatch('deleted');
    }
}
