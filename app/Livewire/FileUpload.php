<?php

namespace App\Livewire;

use App\Imports\StatsImport;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class FileUpload extends Component
{
    use WithFileUploads;

    public $file;
    public $isValid;
    public $errors = [];

    public function render()
    {
        return view('livewire.file-upload');
    }

    public function updatedFIle()
    {

        $this->isValid = false;

        $this->validate([
            'file' => 'file|mimes:xlsx,xls,csv|max:5120', // 5MB Max
        ]);

        $this->isValid = true;
    }

    public function save()
    {

        try {
            Excel::import(new StatsImport, $this->file);
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();

            foreach ($failures as $failure) {
                $this->addError('file', "Row {$failure->row()}: {$failure->errors()[0]}");

                $this->errors[] = "Row {$failure->row()}: {$failure->errors()[0]}";
            }

            return;
        }
        return redirect(request()->header('Referer'));

        // session()->flash('message', 'Products imported successfully!');
    }
}
