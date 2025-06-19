<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('pages.login');
    }

    public function login(Request $request)
    {
        // Validate input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        $account = User::where('email', $credentials['email'])->first();
        if (!empty($account))
            if ($account->status === 0) {
                return redirect()->back()->with('error', 'Tài khoản đã bị khóa. Hãy liên hệ quản trị viên!');
            } else {
                if (Hash::check($credentials['password'], $account->password)) {
                    session()->put('user', $account);
                    return redirect('/');
                } else {
                    return redirect()->back()->with('warning', 'Mật khẩu không chính xác!');
                }
            }
        else {
            return redirect('/auth/login')->with('error', 'Tài khoản không tồn tại!');
        }
    }

    public function logout()
    {
        session()->flush();
        return redirect('/auth/login')->with('warning', 'Đã đăng xuất tài khoản!');
    }

    public function showStudentLogin()
    {
        return view('pages.student_login');
    }

    public function studentLogin(Request $request)
    {
        // Validate input
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $credentials = [
            'username' => $request->username,
            'password' => $request->password
        ];

        $student = Student::where('username', $credentials['username'])->first();
        if (!empty($student)) {
            if (Hash::check($credentials['password'], $student->password)) {
                session()->put('student', $student);
                return redirect()->route('student.borrow');
            } else {
                return redirect()->back()->with('warning', 'Mật khẩu không chính xác!');
            }
        } else {
            return redirect()->back()->with('error', 'Tài khoản không tồn tại!');
        }
    }
}
