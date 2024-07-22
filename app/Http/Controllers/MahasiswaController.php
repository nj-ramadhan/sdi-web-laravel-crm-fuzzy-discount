<?php

namespace App\Http\Controllers;

//import model mahasiswa
use App\Models\Mahasiswa; 

//import return type View
use Illuminate\View\View;

//import return type redirectResponse
use Illuminate\Http\Request;

//import Http Request
use Illuminate\Http\RedirectResponse;

//import Facades Storage
use Illuminate\Support\Facades\Storage;


class MahasiswaController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index() : View
    {
        //get all mahasiswa
        $mahasiswa = Mahasiswa::latest()->paginate(10);

        //render view with mahasiswa
        return view('mahasiswa.index', compact('mahasiswa'));
    }

    /**
     * create
     *
     * @return View
     */
    public function create(): View
    {
        return view('mahasiswa.create');
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
            'id'           => 'required|min:12',
            'image'          => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'nama'          => 'required|min:10',
            'angkatan'      => 'required|numeric',
            'kelas'         => 'required|min:5',
            'jabatan'       => 'required|min:5'
        ]);

        //upload image
        $image = $request->file('image');
        $image->storeAs('public/mahasiswa', $image->hashName());

        //create mahasiswa
        Mahasiswa::create([
            'id'           => $request->id,
            'image'          => $image->hashName(),
            'nama'          => $request->nama,
            'angkatan'      => $request->angkatan,
            'kelas'         => $request->kelas,
            'jabatan'       => $request->jabatan
        ]);

        //redirect to index
        return redirect()->route('mahasiswa.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }
    
    /**
     * show
     *
     * @param  mixed $id
     * @return View
     */
    public function show(string $id): View
    {
        //get mahasiswa by ID
        $mahasiswa = Mahasiswa::findOrFail($id);

        //render view with mahasiswa
        return view('mahasiswa.show', compact('mahasiswa'));
    }
    
    /**
     * edit
     *
     * @param  mixed $id
     * @return View
     */
    public function edit(string $id): View
    {
        //get mahasiswa by ID
        $mahasiswa = Mahasiswa::findOrFail($id);

        //render view with mahasiswa
        return view('mahasiswa.edit', compact('mahasiswa'));
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
            'image'          => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'nama'          => 'required|min:10',
            'angkatan'      => 'required|numeric',
            'kelas'         => 'required|min:5',
            'jabatan'       => 'required|min:5'
        ]);

        //get mahasiswa by ID
        $mahasiswa = Mahasiswa::findOrFail($id);

        //check if image is uploaded
        if ($request->hasFile('image')) {

            //upload new image
            $image = $request->file('image');
            $image->storeAs('public/mahasiswa', $image->hashName());

            //delete old image
            Storage::delete('public/mahasiswa/'.$mahasiswa->image);

            //update mahasiswa with new image
            $mahasiswa->update([
                'image'          => $image->hashName(),
                'nama'          => $request->nama,
                'angkatan'      => $request->angkatan,
                'kelas'         => $request->kelas,
                'jabatan'       => $request->jabatan
            ]);

        } else {

            //update mahasiswa without image
            $mahasiswa->update([
                'image'          => $image->hashName(),
                'nama'          => $request->nama,
                'angkatan'      => $request->angkatan,
                'kelas'         => $request->kelas,
                'jabatan'       => $request->jabatan
            ]);
        }

        //redirect to index
        return redirect()->route('mahasiswa.index')->with(['success' => 'Data Berhasil Diubah!']);
    }
    
    /**
     * destroy
     *
     * @param  mixed $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        //get mahasiswa by ID
        $mahasiswa = Mahasiswa::findOrFail($id);

        //delete image
        Storage::delete('public/mahasiswa/'. $mahasiswa->image);

        //delete mahasiswa
        $mahasiswa->delete();

        //redirect to index
        return redirect()->route('mahasiswa.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
