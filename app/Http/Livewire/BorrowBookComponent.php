<?php

namespace App\Http\Livewire;

use App\Models\Author;
use App\Models\Book;
use App\Models\BookCategory;
use App\Models\BorrowBook;
use App\Models\BorrowBookDetail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Collection;
use Carbon\Carbon;

class BorrowBookComponent extends AppComponent
{
    public $state = [];
    public $searchInput = '';
    public $showEditModal;
    public $borrowIdReturned;
    public $borrowIdRemove;
    public $i = 0;
    public $borrowBookDetails;
    public Collection $lateReturns;
    public $lateReturnsCount = 0;

    public function mount()
    {
        // Lấy dữ liệu ngay khi component được khởi tạo
        $this->loadLateReturns();
    }

    public function loadLateReturns()
    {
        $this->lateReturns = BorrowBook::where('endDate', '<=', Carbon::today())
            ->where('status', false)
            ->get();

        $this->lateReturnsCount = $this->lateReturns->count();
    }

    public function render()
    {
        $books = Book::where('book_type', 1)->get();
        $authors = Author::latest()->get();
        $categories = BookCategory::get();

        $borrowBooks = BorrowBook::where('student_name', 'LIKE', '%' . $this->searchInput . '%')
            ->orWhere('student_code', 'LIKE', '%' . $this->searchInput . '%')
            ->paginate(10);

        // Lấy danh sách trễ hạn
        $today = Carbon::today();
        $this->lateReturns = BorrowBook::where('endDate', '<=', $today)
            ->where('status', false)
            ->get();

        $this->lateReturnsCount = $this->lateReturns->count();

        return view('livewire.borrow-book-component', [
            'books' => $books,
            'authors' => $authors,
            'categories' => $categories,
            'borrowBooks' => $borrowBooks,
            'lateReturns' => $this->lateReturns,
            'lateReturnsCount' => $this->lateReturnsCount,
        ]);
    }

    public function borrowBook()
    {
        $this->state = [];
        $this->showEditModal = false;
        $this->dispatchBrowserEvent('show-form');
    }

    public function addBookRow()
    {
        if (!isset($this->state['books'])) {
            $this->dispatchBrowserEvent('toastr-danger', [
                'message' => 'Hãy thêm sách vào phiếu mượn sách!',
            ]);
        } else {
            $book = Book::find($this->state['books'][$this->i]['book_id']);

            if ($book->stock < 1) {
                $this->dispatchBrowserEvent('toastr-danger', [
                    'message' => 'Sách này không có sẳn trong kho!',
                ]);
                unset($this->state['books'][$this->i]);
            } else {
                $this->state['books'][$this->i]['book_name'] = $book->book_name;
                $this->state['books'][$this->i]['quantity'] = 1;
                $this->i++;
            }
        }
    }

    public function removeBookRow(int $i)
    {
        unset($this->state['books'][$i]);
        $this->i--;
    }

    public function createBorrowBook()
    {
        $validatedData = Validator::make($this->state, [
            'beginDate' => 'required|date',
            'endDate' => 'required|date|after:beginDate',
            'student_code' => 'required|min:5|max:10',
            'student_name' => 'required|max:50',
            'note' => 'max:100',
        ])->validate();

        $totalQuantity = 0;
        foreach ($this->state['books'] as $book) {
            $totalQuantity += $book['quantity'];
        }
        $validatedData['quantity'] = $totalQuantity;
        $validatedData['status'] = false;
        $newBorrowBook = BorrowBook::create($validatedData);

        foreach ($this->state['books'] as $key => $book) {
            $borrowBookDetail = [
                'book_id' => $book['book_id'],
                'borrow_book_id' => $newBorrowBook->id,
                'quantity' => $book['quantity'],
            ];

            BorrowBookDetail::create($borrowBookDetail);

            $updateBook = Book::find($book['book_id']);
            $updateBook->stock -= $book['quantity'];
            $updateBook->save();
        }

        $this->dispatchBrowserEvent('hide-form', [
            'message' => 'Đã thêm phiếu mượn sách thành công!',
        ]);
    }

    public function showBorrowBookDetail(int $id)
    {
        $borrowBook = BorrowBook::find($id);
        $this->borrowBookDetails = $borrowBook->details;
        $this->dispatchBrowserEvent('show-detail');
    }

    public function confirmReturnedBook(int $id)
    {
        $this->borrowIdReturned = $id;
        $this->dispatchBrowserEvent('show-confirm-modal');
    }

    public function returnedBook()
    {
        $borrowBook = BorrowBook::findOrFail($this->borrowIdReturned);
        $borrowBook->status = true;
        $borrowBook->save();

        foreach ($borrowBook->details as $detail) {
            $book = Book::find($detail->book_id);
            $book->stock += $detail->quantity;
            $book->save();
        }

        $this->dispatchBrowserEvent('hide-confirm-modal', [
            'message' => 'Đã cập nhật trạng thái thành công!',
        ]);
    }

    public function confirmRemoveBorrowBook(int $id)
    {
        $this->borrowIdRemove = $id;
        $this->dispatchBrowserEvent('show-delete-modal');
    }

    public function removeBorrowBook()
    {
        $borrowBook = BorrowBook::findOrFail($this->borrowIdRemove);

        foreach ($borrowBook->details as $detail) {
            $detail->delete();
        }

        $borrowBook->delete();

        $this->dispatchBrowserEvent('hide-delete-modal', [
            'message' => 'Xóa phiếu mượn sách thành công!',
            'type' => 'success'
        ]);
    }

    public function showAllLateReturns()
    {
        $this->dispatchBrowserEvent('show-all-late-returns-modal');
    }
}
