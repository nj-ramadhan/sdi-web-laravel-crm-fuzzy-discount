<?php

namespace App\Http\Controllers;

//import model berkas program
use App\Models\UangKas; 

//import return type View
use Illuminate\View\View;

//import return type redirectResponse
use Illuminate\Http\Request;

//import Http Request
use Illuminate\Http\RedirectResponse;

//import Facades Storage
use Illuminate\Support\Facades\Storage;

class UangKasController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index() : View
    {
        //get all uang_kas
        $uang_kas = UangKas::latest()->paginate(10);

        //render view with uang_kas
        return view('uang_kas.index', compact('uang_kas'));
    }

    /**
     * create
     *
     * @return View
     */
    public function create(): View
    {
        return view('uang_kas.create');
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
            'nama'              => 'required|min:10',
            'nim'               => 'required|min:10',
            'tanggal_bayar'     => 'required|date',
            'nominal_bayar'     => 'required|numeric|min:10',
            'status'            => 'nullable|min:1'
        ]);

        //create uang_kas
        UangKas::create([
            'nama'              => $request->nama,
            'nim'               => $request->nim,
            'tanggal_bayar'     => $request->tanggal_bayar,
            'nominal_bayar'     => $request->nominal_bayar,
            'status'            => $request->status
        ]);

        //redirect to index
        return redirect()->route('uang_kas.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }
    
    /**
     * show
     *
     * @param  mixed $id
     * @return View
     */
    public function show(string $id): View
    {
        //get uang_kas by ID
        $uang_kas = UangKas::findOrFail($id);

        //render view with uang_kas
        return view('uang_kas.show', compact('uang_kas'));
    }
    
    /**
     * edit
     *
     * @param  mixed $id
     * @return View
     */
    public function edit(string $id): View
    {
        //get uang_kas by ID
        $uang_kas = UangKas::findOrFail($id);

        //render view with uang_kas
        return view('uang_kas.edit', compact('uang_kas'));
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
            'nama'              => 'required|min:10',
            'nim'               => 'required|min:10',
            'tanggal_bayar'     => 'required|date',
            'nominal_bayar'     => 'required|numeric|min:10',
            'status'            => 'nullable|min:1'
        ]);

        //get uang_kas by ID
        $uang_kas = UangKas::findOrFail($id);

        $uang_kas->update([
            'nama'              => $request->nama,
            'nim'               => $request->nim,
            'tanggal_bayar'     => $request->tanggal_bayar,
            'nominal_bayar'     => $request->nominal_bayar,
            'status'            => $request->status
        ]);

        //redirect to index
        return redirect()->route('uang_kas.index')->with(['success' => 'Data Berhasil Diubah!']);
    }
    
    /**
     * destroy
     *
     * @param  mixed $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        //get uang_kas by ID
        $uang_kas = UangKas::findOrFail($id);

        //delete image
        Storage::delete('public/uang_kas/'. $uang_kas->document);

        //delete uang_kas
        $uang_kas->delete();

        //redirect to index
        return redirect()->route('uang_kas.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
