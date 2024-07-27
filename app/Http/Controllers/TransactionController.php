<?php

namespace App\Http\Controllers;

//import model 
use App\Models\Transaction;

//import return type View
use Illuminate\View\View;

//import return type redirectResponse
use Illuminate\Http\Request;

//import Http Request
use Illuminate\Http\RedirectResponse;

//import Facades Storage
use Illuminate\Support\Facades\Storage;

class TransactionController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index() : View
    {
        //get all transactions
        $transactions = Transaction::latest()->get();
        $total_transaction = $transactions->sum('amount_transaction');

        //render view with transactions
        return view('transactions.index', compact('transactions'), ['total_transaction' => $total_transaction]);
    }

    /**
     * create
     *
     * @return View
     */
    public function create(): View
    {
        return view('transactions.create');
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        //validate form
        $request->validate([
            'amount_transaction'         => 'required|numeric',
        ]);

        //create transactions
        Transaction::create([
            'customer_id'               => $request->customer_id,
            'amount_transaction'         => $request->amount_transaction,
        ]);

        //redirect to index
        return redirect()->route('transactions.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }
    
    /**
     * show
     *
     * @param  mixed $id
     * @return View
     */
    public function show(string $id): View
    {
        //get transactions by ID
        $transactions = Transaction::findOrFail($id);

        //render view with transactions
        return view('transactions.show', compact('transactions'));
    }
    
    /**
     * edit
     *
     * @param  mixed $id
     * @return View
     */
    public function edit(string $id): View
    {
        //get transactions by ID
        $transactions = Transaction::findOrFail($id);

        //render view with transactions
        return view('transactions.edit', compact('transactions'));
    }
        
    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id): RedirectResponse
    {
        //validate form
        $request->validate([
            'amount_transaction'         => 'required|numeric',
        ]);

        
        //get transactions by ID
        $transactions = Transaction::findOrFail($id);

        //update transactions without image
        $transactions->update([
            'customer_id'             => $request->customer_id,
            'amount_transaction'         => $request->amount_transaction,

        ]);

        //redirect to index
        return redirect()->route('transactions.index')->with(['success' => 'Data Berhasil Diubah!']);
    }
    
    /**
     * destroy
     *
     * @param  mixed $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        //get transactions by ID
        $transactions = Transaction::findOrFail($id);

        //delete transactions
        $transactions->delete();

        //redirect to index
        return redirect()->route('transactions.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }

}
