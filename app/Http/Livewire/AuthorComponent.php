<?php

namespace App\Http\Livewire;

use App\Models\Author;
use Illuminate\Support\Facades\Validator;

class AuthorComponent extends AppComponent
{
    public $state = [];
    public $author;
    public $showEditModal = false;
    public $authorIdBeingRemoved = null;
    public $searchInput = '';

    public function render()
    {
        $authors = Author::where('name', 'LIKE', '%' . $this->searchInput . '%')->paginate(10);

        return view('livewire.author-component', [
            'authors' => $authors,
        ]);
    }

    public function addAuthor()
    {
        $this->state = [];
        $this->showEditModal = false;
        $this->dispatchBrowserEvent('show-form');
    }

    public function createAuthor()
    {
        $validatedData = Validator::make($this->state, [
            'name' => 'required',
            'birthday' => 'date',
        ])->validate();

        Author::create($validatedData);
        $this->dispatchBrowserEvent('hide-form', [
            'message' => 'Đã thêm tác giả ' . $validatedData['name'] . ' thành công!',
        ]);

        return redirect()->back();
    }

    public function editAuthor(Author $author)
    {
        $this->state = $author->toArray();
        $this->author = $author;
        $this->showEditModal = true;
        $this->dispatchBrowserEvent('show-form');
    }

    public function updateAuthor()
    {
        $validatedData = Validator::make($this->state, [
            'code' => "min:3|max:6|unique:authors,code,{$this->author->id},id",
            'name' => 'required',
        ])->validate();

        $validatedData['birthday'] = $this->state['birthday'];

        $this->author->update($validatedData);
        $this->dispatchBrowserEvent('hide-form', [
            'message' => 'Đã cập nhật tác giả ' . $validatedData['name'] . ' thành công!',
        ]);

        return redirect()->back();
    }

    public function confirmAuthorRemoval($authorId)
    {
        $this->authorIdBeingRemoved = $authorId;
        $this->dispatchBrowserEvent('show-delete-modal');
    }

    public function removeAuthor()
    {
        try {
            $author = Author::findOrFail($this->authorIdBeingRemoved);
            $author->delete();

            $this->dispatchBrowserEvent('hide-delete-modal', [
                'message' => 'Xóa tác giả ' . $author->name . ' thành công!',
                'type' => 'success'
            ]);
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('hide-delete-modal', [
                'message' => 'Xóa tác giả không thành công! Vui lòng thử lại!',
                'type' => 'error',
            ]);
        }
    }
}
