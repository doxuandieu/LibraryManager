<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Book;
use App\Models\BorrowBook;

class StudentController extends Controller
{
    // public function dashboard()
    // {
    //     return view('livewire.student.student_dashboard');
    // }

    public function profile()
    {
        $student = session('student');
        return view('livewire.student.student_profile', compact('student'));
    }

    public function updateProfile(Request $request)
    {
        //validate
        $request->validate([
            'name' => 'required|string|max:255',
            'class' => 'required|string|max:255',
            'student_id' => 'required|string|max:255',
            'major' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'birthday' => 'required|date',
            'username' => 'required|string|max:255',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $student = session('student');
        $studentModel = Student::find($student['id']);

        // Cập nhật thông tin sinh viên
        $studentModel->name = $request->name;
        $studentModel->class = $request->class;
        $studentModel->student_id = $request->student_id;
        $studentModel->major = $request->major;
        $studentModel->phone = $request->phone;
        $studentModel->birthday = $request->birthday;
        $studentModel->username = $request->username;
        // Cập nhật mật khẩu nếu có
        if ($request->filled('password')) {
            $studentModel->password = Hash::make($request->password);
        }

        $studentModel->save();
        // Cập nhật lại session
        session()->put('student', $studentModel);
        return redirect()->route('student.profile')->with('success', 'Thông tin cá nhân đã được cập nhật!');
    }


    public function showBorrowPage(Request $request)
    {
        $search = $request->input('search');
        $books = Book::query()
            ->when($search, function ($query, $search) {
                return $query->where('book_name', 'like', "%{$search}%")
                    ->orWhere('book_code', 'like', "%{$search}%")
                    ->orWhereHas('category', function ($query) use ($search) {
                        $query->where('category_name', 'like', "%{$search}%");
                    })
                    ->orWhere(function ($query) use ($search) {
                        if (stripos('sách đọc', $search) !== false || stripos('đọc', $search) !== false) {
                            $query->where('book_type', 0);
                        } elseif (stripos('sách mượn', $search) !== false || stripos('mượn', $search) !== false) {
                            $query->where('book_type', 1);
                        }
                    });
            })
            ->get();

        return view('livewire.student.student_borrow_book', compact('books'));
    }

    public function borrowBook(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'student_name' => 'required|string|max:255',
            'student_code' => 'required|string|max:255',
            'beginDate' => 'required|date',
            'endDate' => 'required|date|after:beginDate',
            'quantity' => 'required|integer|min:1',
        ]);

        $borrowBook = BorrowBook::create([
            'student_code' => $request->student_code,
            'student_name' => $request->student_name,
            'quantity' => $request->quantity,
            'beginDate' => $request->beginDate,
            'endDate' => $request->endDate,
            'status' => 0,
        ]);

        $borrowBook->details()->create([
            'book_id' => $request->book_id,
            'quantity' => $request->quantity,
        ]);

        return redirect()->route('student.borrow')->with('success', 'Đặt sách thành công!');
    }
}
