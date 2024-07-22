<?php

namespace App\Http\Controllers;

//import model berkas program
use App\Models\PresensiPiket; 

//import return type View
use Illuminate\View\View;

//import return type redirectResponse
use Illuminate\Http\Request;

//import Http Request
use Illuminate\Http\RedirectResponse;

//import Facades Storage
use Illuminate\Support\Facades\Storage;

class PresensiPiketController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index() : View
    {
        //get all presensi_piket
        $presensi_piket = PresensiPiket::latest()->paginate(10);

        //render view with presensi_piket
        return view('presensi_piket.index', compact('presensi_piket'));
    }

    /**
     * create
     *
     * @return View
     */
    public function create(): View
    {
        return view('presensi_piket.create');
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
            'nama'          => 'required|min:10',
            'nim'           => 'required|min:10',
            'tanggal'       => 'required|date',
            'jam_datang'    => 'required',
            'jam_pulang'    => 'required',
            'tugas'         => 'required|min:10'
        ]);

        //create presensi_piket
        PresensiPiket::create([
            'nama'          => $request->nama,
            'nim'           => $request->nim,
            'tanggal'       => $request->tanggal,
            'jam_datang'    => $request->jam_datang,
            'jam_pulang'    => $request->jam_pulang,
            'tugas'         => $request->tugas
        ]);

        //redirect to index
        return redirect()->route('presensi_piket.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }
    
    /**
     * show
     *
     * @param  mixed $id
     * @return View
     */
    public function show(string $id): View
    {
        //get presensi_piket by ID
        $presensi_piket = PresensiPiket::findOrFail($id);

        //render view with presensi_piket
        return view('presensi_piket.show', compact('presensi_piket'));
    }
    
    /**
     * edit
     *
     * @param  mixed $id
     * @return View
     */
    public function edit(string $id): View
    {
        //get presensi_piket by ID
        $presensi_piket = PresensiPiket::findOrFail($id);

        //render view with presensi_piket
        return view('presensi_piket.edit', compact('presensi_piket'));
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
            'nama'          => 'required|min:10',
            'nim'           => 'required|min:10',
            'tanggal'       => 'required|date',
            'jam_datang'    => 'required',
            'jam_pulang'    => 'required',
            'tugas'         => 'required|min:10'
        ]);

        //get presensi_piket by ID
        $presensi_piket = PresensiPiket::findOrFail($id);

        $presensi_piket->update([
            'nama'          => $request->nama,
            'nim'           => $request->nim,
            'tanggal'       => $request->tanggal,
            'jam_datang'    => $request->jam_datang,
            'jam_pulang'    => $request->jam_pulang,
            'tugas'         => $request->tugas
        ]);
        
        //redirect to index
        return redirect()->route('presensi_piket.index')->with(['success' => 'Data Berhasil Diubah!']);
    }
    
    /**
     * destroy
     *
     * @param  mixed $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        //get presensi_piket by ID
        $presensi_piket = PresensiPiket::findOrFail($id);

        //delete image
        Storage::delete('public/presensi_piket/'. $presensi_piket->document);

        //delete presensi_piket
        $presensi_piket->delete();

        //redirect to index
        return redirect()->route('presensi_piket.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
