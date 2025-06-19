<?php

namespace App\Http\Livewire;

use App\Models\Book;
use App\Models\Receipt;
use App\Models\ReceiptDetail;
use Illuminate\Support\Facades\Validator;

class ReceiptComponent extends AppComponent
{
    public $state = [];
    public $showEditModal;
    public $receiptIdBeingRemoved;
    public $receiptDetail;
    public $i = 0;

    protected $listeners = [
        'refresh-data' => '$refresh'
    ];

    public function render()
    {
        $receipts = Receipt::latest()->paginate(10);
        $books = Book::latest()->get();
        return view('livewire.receipt-component',[
            'receipts' => $receipts,
            'books' => $books,
        ]);
    }

    public function addReceipt()
    {
        $this->state = [];
        $this->showEditModal = false;
        $this->dispatchBrowserEvent('show-form');
        $this->emit('refresh-data');
    }

    public function addBookRow()
    {
        if(!isset($this->state['books']))
        {
            $this->dispatchBrowserEvent('toastr-danger', [
                'message' => 'Hãy thêm sách vào phiếu nhập hàng!',
            ]);
        }
        else{
            $book = Book::find($this->state['books'][$this->i]['book_id']);
            $this->state['books'][$this->i]['book_name'] = $book->book_name;
            $this->i++;
        }
    }

    public function removeRow(int $i)
    {
        unset($this->state['books'][$i]);
        $this->state['books'] = array_values($this->state['books']);
    }

    public function createReceipt()
    {
        $validatedData = Validator::make($this->state, [
            'receiver' => 'required|max:50',
        ])->validate();
        $validatedData['date'] = now()->toDateTime();
        $newReceipt = Receipt::create($validatedData);

        foreach($this->state['books'] as $key => $book)
        {
            $updateBook = Book::find($book['book_id']);
            $updateBook->stock += $book['quantity'];
            $updateBook->save();

            $this->state['books'][$key]['receipt_id'] = $newReceipt->id;
            ReceiptDetail::create($this->state['books'][$key]);
        }

        $this->dispatchBrowserEvent('hide-form', [
            'message' => 'Đã thêm phiếu nhập thành công!',
        ]);
    }

    public function confirmReceiptRemoval($receiptId)
    {
        $this->receiptIdBeingRemoved = $receiptId;
        $this->dispatchBrowserEvent('show-delete-modal');
    }

    public function removeReceipt()
    {
        $receipt = Receipt::find($this->receiptIdBeingRemoved);
        $receipt->delete();

        $this->dispatchBrowserEvent('hide-delete-modal', [
            'message' => 'Xóa phiếu nhập thành công!',
            'type' => 'success'
        ]);
    }

    public function showReceiptDetail(int $id)
    {
        $receipt = Receipt::find($id);
        $this->receiptDetail = $receipt;
        $this->dispatchBrowserEvent('show-detail');
    }
}
