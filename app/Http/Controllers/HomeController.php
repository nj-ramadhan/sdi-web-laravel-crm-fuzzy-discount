<?php

namespace App\Http\Controllers;

use App\Models\Transaction; 
use App\Models\Customer; 

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $customers = Customer::latest()->get();
        $count_customer = $customers->count();
        
        $transactions = Transaction::latest()->get();
        $count_transaction = $transactions->count();
        $member_transaction = $transactions->where('customer_id', '<>', null)->count();
        $total_transaction = $transactions->sum('amount_transaction');
        $average_transaction = floor($transactions->avg('amount_transaction'));
        $total_member_transaction = $transactions->where('customer_id', '<>', null)->sum('amount_transaction');

        //render view with transactions
        return view('dashboard.home',
        ['count_customer' => $count_customer,
        'count_transaction' => $count_transaction,
        'member_transaction' => $member_transaction,
        'total_transaction' => $total_transaction,
        'average_transaction' => $average_transaction,
        'total_member_transaction' => $total_member_transaction]);
    }   
}
