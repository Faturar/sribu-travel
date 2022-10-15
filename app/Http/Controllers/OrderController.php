<?php

namespace App\Http\Controllers;

use App\Transaction;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index($users_id) {
        $items = Transaction::where('users_id', $users_id)->with([
            'details', 'travel_package', 'user'
        ])->get();

        return view('pages.order', [
            'items' => $items
        ]);
    }

    public function detail($id) {
        $detail = Transaction::where('id', $id)->with([
            'details', 'travel_package', 'user'
        ])->get();

        return response()->json([
            'detail' => $detail,
        ]);
    }
}
