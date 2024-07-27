<?php

namespace App\Http\Controllers;

//import model customers
use App\Models\Customer; 
use App\Models\Transaction; 

//import return type View
use Illuminate\View\View;

//import return type redirectResponse
use Illuminate\Http\Request;

//import Http Request
use Illuminate\Http\RedirectResponse;

//import Facades Storage
use Illuminate\Support\Facades\Storage;

class CustomerController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    // public function index(): View
    // {
    //     //get all customers
    //     $customers = Customer::latest()->paginate(10);

    //     //render view with customers
    //     return view('customers.index', compact('customers'));
    // }
    public function index()
    {
        //get all customers
        $customers = Customer::latest()->get();
        
        //render view with customers
        return view('customers.index', compact('customers'));
    }

    /**
     * create
     *
     * @return View
     */
    public function create(): View
    {
        return view('customers.create');
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
            'id'            => 'required|min:11',
            'name'          => 'required|min:5',
            'address'       => 'required|min:10',
        ]);

        //create customers
        Customer::create([
            'id'            => $request->id,
            'name'          => $request->name,
            'address'       => $request->address
        ]);

        //redirect to index
        return redirect()->route('customers')->with(['success' => 'Data Berhasil Disimpan!']);
    }
    
    /**
     * show
     *
     * @param  mixed $id
     * @return View
     */
    public function show(string $id): View
    {
        //get customers by ID
        $customers = Customer::findOrFail($id);

        //render view with customers
        return view('customers.show', compact('customers'));
    }
    
    /**
     * edit
     *
     * @param  mixed $id
     * @return View
     */
    public function edit(string $id): View
    {
        //get customers by ID
        $customers = Customer::findOrFail($id);

        //render view with customers
        return view('customers.edit', compact('customers'));
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
            'id'         => 'required|min:11',
            'name'          => 'required|min:10',
            'address'       => 'required|min:10',
        ]);

        
        //get customers by ID
        $customers = Customer::findOrFail($id);

        //update customers without image
        $customers->update([
            'id'             => $request->id,
            'name'              => $request->name,
            'address'           => $request->address,
            'total_transaction' => $request->total_transaction,
            'total_point'       => $request->total_point,
            'grade'             => $request->grade

        ]);

        //redirect to index
        return redirect()->route('customers.index')->with(['success' => 'Data Berhasil Diubah!']);
    }
    
    /**
     * destroy
     *
     * @param  mixed $phone
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        //get customers by ID
        $customers = Customer::findOrFail($id);

        //delete customers
        $customers->delete();

        //redirect to index
        return redirect()->route('customers.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }

    public function sum_transaction()
    {
        //get all customers
        $customers = Customer::latest()->get();
        $total = $customers->sum('amount_transaction');

        //render view with customers
        return view('customers.index', ['total' => $total]);
    }
}


