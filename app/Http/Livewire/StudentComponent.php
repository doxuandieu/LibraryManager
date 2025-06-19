<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;

class StudentComponent extends Component
{
    use WithPagination;

    public $name, $class, $student_id, $major, $phone, $birthday, $username, $password;
    public $studentIdBeingUpdated = null;
    public $studentIdBeingDeleted = null;
    public $isOpen = false;
    public $searchInput = '';

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $students = Student::where('name', 'like', '%' . $this->searchInput . '%')
            ->orWhere('student_id', 'like', '%' . $this->searchInput . '%')
            ->orWhere('class', 'like', '%' . $this->searchInput . '%')
            ->paginate(10);

        return view('livewire.student-component', compact('students'));
    }

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    private function resetInputFields()
    {
        $this->name = '';
        $this->class = '';
        $this->student_id = '';
        $this->major = '';
        $this->phone = '';
        $this->birthday = '';
        $this->username = '';
        $this->password = '';
        $this->studentIdBeingUpdated = null;
    }

    public function store()
    {
        $rules = [
            'name' => 'required',
            'class' => 'required',
            'student_id' => 'required|unique:students,student_id,' . $this->studentIdBeingUpdated,
            'major' => 'required',
            'phone' => 'required|digits:10',
            'birthday' => 'required|date',
            'username' => 'required|unique:students,username,' . $this->studentIdBeingUpdated,
        ];

        if (!$this->studentIdBeingUpdated) {
            $rules['password'] = 'required|min:6';
        }

        $this->validate($rules);

        $studentData = [
            'name' => $this->name,
            'class' => $this->class,
            'student_id' => $this->student_id,
            'major' => $this->major,
            'phone' => $this->phone,
            'birthday' => $this->birthday,
            'username' => $this->username,
        ];

        if ($this->password) {
            $studentData['password'] = Hash::make($this->password);
        }

        Student::updateOrCreate(['id' => $this->studentIdBeingUpdated], $studentData);

        session()->flash('message', $this->studentIdBeingUpdated ? 'Cập nhật sinh viên thành công.' : 'Tạo sinh viên thành công.');

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $student = Student::findOrFail($id);
        $this->studentIdBeingUpdated = $id;
        $this->name = $student->name;
        $this->class = $student->class;
        $this->student_id = $student->student_id;
        $this->major = $student->major;
        $this->phone = $student->phone;
        $this->birthday = $student->birthday;
        $this->username = $student->username;
        $this->password = '';

        $this->openModal();
    }

    public function confirmStudentDeletion($id)
    {
        $this->studentIdBeingDeleted = $id;
    }

    public function deleteStudent()
    {
        Student::find($this->studentIdBeingDeleted)->delete();
        session()->flash('message', 'Xóa sinh viên thành công.');
        $this->studentIdBeingDeleted = null;
    }
}
