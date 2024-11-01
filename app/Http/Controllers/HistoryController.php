<?php

namespace App\Http\Controllers;

use App\Models\History;

class HistoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function admin()
    {

        $history = History::orderBy('id', 'desc')->paginate(10);

        return view('history.admin', with([
            'history' => $history,
        ]));
    }
}
