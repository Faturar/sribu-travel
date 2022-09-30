<?php

namespace App\Http\Controllers;

use App\Transaction;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index($id) {
        $items = Transaction::where('id', $id)->with([
            'details', 'travel_package', 'user'
        ])->get();

        return view('pages.order', [
            'items' => $items
        ]);
    }
}
