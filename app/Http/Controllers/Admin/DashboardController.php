<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Transaction;
use App\TravelPackage;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $travel_package = TravelPackage::all()->count();
        $transaction = Transaction::all()->count();
        $transaction_pending = Transaction::where('transaction_status', '=', 'PENDING')->count();
        $transaction_success = Transaction::where('transaction_status', '=', 'SUCCESS')->count();

        return view('pages.admin.dashboard', [
            'travel_package' => $travel_package,
            'transaction' => $transaction,
            'transaction_pending' => $transaction_pending,
            'transaction_success' => $transaction_success,
        ]);
    }
}
