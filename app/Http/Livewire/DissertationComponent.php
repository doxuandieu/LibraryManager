<?php

namespace App\Http\Livewire;

use App\Imports\ImportDissertation;
use App\Models\Dissertation;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class DissertationComponent extends AppComponent
{
    use WithFileUploads;
    public $excelFile;
    public $dissertationIdSubmitted;
    public $dissertationIdRemove;
    public $searchInput = '';

    public function render()
    {
        $query = Dissertation::query();

        if ($this->searchInput) {
            $query->where(function ($subQuery) {
                $subQuery->where('semester', 'LIKE', '%' . $this->searchInput . '%')
                    ->orWhere('student_id', 'LIKE', '%' . $this->searchInput . '%')
                    ->orWhere('class_id', 'LIKE', '%' . $this->searchInput . '%');
            });
        }

        $dissertations = $query->orderBy('year', 'desc')->paginate(20);

        return view('livewire.dissertation-component', [
            'dissertations' => $dissertations,
        ]);
    }

    public function import()
    {
        $this->validate([
            'excelFile' => 'required|mimes:xlsx,xls',
        ]);

        $importClass = new ImportDissertation;
        Excel::import($importClass, $this->excelFile);

        $this->dispatchBrowserEvent('toastr-success', [
            'message' => 'Đã tải lên thành công!',
        ]);

        $this->reset(['excelFile']);
    }


    public function confirmSubmitted(int $id)
    {
        $this->dissertationIdSubmitted = $id;
        $this->dispatchBrowserEvent('show-confirm-modal');
    }

    public function submittedDissertation()
    {
        $dissertation = Dissertation::findOrFail($this->dissertationIdSubmitted);
        $dissertation->status = true;
        $dissertation->save();

        $this->dispatchBrowserEvent('hide-confirm-modal', [
            'message' => 'Đã cập nhật trạng thái thành công!',
        ]);
    }

    public function confirmDissertationRemoval(int $id)
    {
        $this->dissertationIdRemove = $id;
        $this->dispatchBrowserEvent('show-delete-modal');
    }

    public function removeDissertation()
    {
        $dissertation = Dissertation::findOrFail($this->dissertationIdRemove);
        $dissertation->delete();

        $this->dispatchBrowserEvent('hide-delete-modal', [
            'message' => 'Xóa luận văn thành công!',
            'type' => 'success'
        ]);
    }
}
