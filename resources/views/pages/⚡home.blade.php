<?php

use Livewire\Attributes\Layout;
use Livewire\Component;

new
#[Layout('layouts::app')]
class extends Component
{
    //
};
?>

<div class="grid md:grid-cols-2 pt-6 gap-6">
    <div>
        <livewire:delete/>

        <livewire:items/>
    </div>
    <div>
        <livewire:notifications/>
    </div>
</div>
