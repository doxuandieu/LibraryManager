<?php

namespace App\Http\Livewire;

use App\Models\Publisher;
use Illuminate\Support\Facades\Validator;

class PublisherComponent extends AppComponent
{
    public $state = [];
    public $publisher;
    public $showEditModal = false;
    public $publisherIdBeingRemoved = null;
    public function render()
    {
        $publishers = Publisher::latest()->paginate(5);

        return view('livewire.publisher-component', [
            'publishers' => $publishers
        ]);
    }

    public function addPublisher()
    {
        $this->state = [];
        $this->showEditModal = false;
        $this->dispatchBrowserEvent('show-form');
    }

    public function createPublisher()
    {
        $validatedData = Validator::make($this->state, [
            'name' => 'required|unique:publishers',
        ])->validate();

        Publisher::create($validatedData);

        $this->dispatchBrowserEvent('hide-form', [
            'message' => 'Đã thêm nhà xuất bản ' . $validatedData['name'] . ' thành công!',
        ]);
    }

    public function editPublisher(Publisher $publisher)
    {
        $this->state = $publisher->toArray();
        $this->publisher = $publisher;
        $this->showEditModal = true;
        $this->dispatchBrowserEvent('show-form');
    }

    public function updatePublisher()
    {
        $validatedData = Validator::make($this->state, [
            'name' => 'required|unique:publishers,name,' . $this->publisher->id,
        ])->validate();

        $this->publisher->update($validatedData);
        $this->dispatchBrowserEvent('hide-form', [
            'message' => 'Đã cập nhật nhà xuất bản ' . $validatedData['name'] . ' thành công!',
        ]);

        return redirect()->back();
    }

    public function confirmPublisherRemoval($publisherId)
    {
        $this->publisherIdBeingRemoved = $publisherId;
        $this->dispatchBrowserEvent('show-delete-modal');
    }

    public function removePublisher()
    {
        $publisher = Publisher::findOrFail($this->publisherIdBeingRemoved);
        $publisher->delete();

        $this->dispatchBrowserEvent('hide-delete-modal', [
            'message' => 'Xóa nhà xuất bản ' . $publisher->name . ' thành công!',
            'type' => 'success'
        ]);
    }
}
