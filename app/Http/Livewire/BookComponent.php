<?php

namespace App\Http\Livewire;

use App\Models\Author;
use App\Models\AuthorBook;
use App\Models\Book;
use App\Models\BookCategory;
use App\Models\Publisher;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class BookComponent extends AppComponent
{
    public $state = [];
    public $updateBook;
    public $bookIdBeingRemoved;
    public $showEditModal = false;
    public $searchInput = '';
    public $authorSearch = '';

    public function render()
    {
        $query = Book::query();

        // Tìm kiếm theo tên sách hoặc mã sách
        $query->where(function ($subQuery) {
            $subQuery->where('book_name', 'LIKE', '%' . $this->searchInput . '%')
                ->orWhere('book_code', 'LIKE', '%' . $this->searchInput . '%');
        });

        // Tìm kiếm theo loại sách (book_type)
        if (str_contains(strtolower($this->searchInput), 'sách đọc') || str_contains(strtolower($this->searchInput), 'đọc')) {
            $query->orWhere('book_type', 0);
        } elseif (str_contains(strtolower($this->searchInput), 'sách mượn') || str_contains(strtolower($this->searchInput), 'mượn')) {
            $query->orWhere('book_type', 1);
        }

        // Lấy danh sách sách và các dữ liệu liên quan
        $books = $query->paginate(10);
        $authors = Author::where('name', 'LIKE', '%' . $this->authorSearch . '%')->get();
        $publishers = Publisher::get();
        $categories = BookCategory::get();

        return view('livewire.book-component', [
            'books' => $books,
            'authors' => $authors,
            'publishers' => $publishers,
            'categories' => $categories,
        ]);
    }

    public function addBook()
    {
        $this->state = [];
        $this->showEditModal = false;
        $this->dispatchBrowserEvent('show-form');
    }

    public function createBook()
    {
        $validatedData = Validator::make($this->state, [
            'book_code' => 'min:3|max:10',
            'book_name' => "required|unique:books,book_name,NULL,id,deleted_at,NULL",
            'book_type' => 'required',
            'publish_year' => 'required',
            'total_pages' => 'required',
            'address' => 'required',
            'price' => 'required',
        ])->validate();

        $validatedData['stock'] = 10;
        $validatedData['publisher_id'] = $this->state['publisher_id'];
        $validatedData['category_id'] = $this->state['category_id'];

        $book = Book::create($validatedData);

        foreach ($this->state['authors'] as $author) {
            AuthorBook::create([
                'author_id' => $author,
                'book_id' => $book->id,
            ]);
        }

        $this->dispatchBrowserEvent('hide-form', [
            'message' => 'Đã thêm sách ' . $validatedData['book_name'] . ' thành công!',
        ]);
    }

    public function editBook(Book $book)
    {
        $this->state = [];
        $this->state = $book->toArray();
        $i = 0;
        foreach ($book->authors as $author) {
            $this->state['authors'][$i] = $author->author_id;
            $i++;
        }
        $this->updateBook = $book;
        $this->showEditModal = true;
        $this->dispatchBrowserEvent('show-form');
    }

    public function updateBook()
    {
        $validatedData = Validator::make($this->state, [
            'book_code' => 'min:3|max:10',
            'book_name' => "required|unique:books,book_name,{$this->updateBook->id},id,deleted_at,NULL",
            'book_type' => 'required',
            'publish_year' => 'required',
            'total_pages' => 'required',
            'address' => 'required',
            'price' => 'required',
            'publisher_id' => 'required',
            'category_id' => 'required',
        ])->validate();

        $this->updateBook->update($validatedData);


        $authors_books = AuthorBook::where('book_id', $this->updateBook->id)->get();

        foreach ($authors_books as $author_book) {
            $author_book->delete();
        }

        foreach ($this->state['authors'] as $author) {
            AuthorBook::create([
                'author_id' => $author,
                'book_id' => $this->updateBook->id,
            ]);
        }

        $this->dispatchBrowserEvent('hide-form', [
            'message' => 'Đã cập nhật sách ' . $validatedData['book_name'] . ' thành công!',
        ]);
    }

    public function confirmBookRemoval($bookId)
    {
        $this->bookIdBeingRemoved = $bookId;
        $this->dispatchBrowserEvent('show-delete-modal');
    }

    public function removeBook()
    {
        $book = Book::findOrFail($this->bookIdBeingRemoved);
        $authors = AuthorBook::where('book_id', $book->id)->get();

        foreach ($authors as $author) {
            $author->delete();
        }

        $book->delete();

        $this->dispatchBrowserEvent('hide-delete-modal', [
            'message' => 'Xóa tác giả ' . $book->name . ' thành công!',
            'type' => 'success'
        ]);
    }
}
