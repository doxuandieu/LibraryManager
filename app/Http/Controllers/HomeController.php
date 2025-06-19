<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Dissertation;

class HomeController extends Controller
{
    public function dashboard()
    {

        $countBook = Book::count();
        $countDissertation = Dissertation::count();
        $countSubmittedDissertation = Dissertation::where('status', true)->count();

        return view('pages.index', [
            'countBook' => $countBook,
            'countDissertation' => $countDissertation,
            'countSubmittedDissertation' => $countSubmittedDissertation,
        ]);
    }
}
