<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Artisan;
use Livewire\Component;

class BackupButton extends Component
{

    public function backUp()
    {
        $exitCode = Artisan::call('backup:run');

        //$output = Artisan::output();

        if ($exitCode !== 0) {
            toastr()->error("There was an error running backup. Contact your system admin");
            return;
        }

        toastr()->success("Backup successfully saved at " . storage_path('app/backups'));
    }

    public function render()
    {
        return view('livewire.backup-button',);
    }
}
