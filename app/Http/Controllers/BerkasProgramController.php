<?php

namespace App\Http\Controllers;

//import model berkas program
use App\Models\BerkasProgram; 

//import return type View
use Illuminate\View\View;

//import return type redirectResponse
use Illuminate\Http\Request;

//import Http Request
use Illuminate\Http\RedirectResponse;

//import Facades Storage
use Illuminate\Support\Facades\Storage;


class BerkasProgramController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index() : View
    {
        //get all berkas_program
        $berkas_program = BerkasProgram::latest()->paginate(10);

        //render view with berkas_program
        return view('berkas_program.index', compact('berkas_program'));
    }

    /**
     * create
     *
     * @return View
     */
    public function create(): View
    {
        return view('berkas_program.create');
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
            'berkas'          => 'required|mimes:pdf,docx|max:2048',
            'judul'          => 'required|min:10',
            'deskripsi'      => 'required|min:10',
            'status'         => 'nullable|min:1'
        ]);

        //upload image
        $berkas = $request->file('berkas');
        $berkas->storeAs('public/berkas_program', $berkas->hashName());

        //create berkas_program
        BerkasProgram::create([
            'berkas'          => $berkas->hashName(),
            'judul'          => $request->judul,
            'deskripsi'      => $request->deskripsi,
            'status'         => $request->status
        ]);

        //redirect to index
        return redirect()->route('berkas_program.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }
    
    /**
     * show
     *
     * @param  mixed $id
     * @return View
     */
    public function show(string $id): View
    {
        //get berkas_program by ID
        $berkas_program = BerkasProgram::findOrFail($id);

        //render view with berkas_program
        return view('berkas_program.show', compact('berkas_program'));
    }
    
    /**
     * edit
     *
     * @param  mixed $id
     * @return View
     */
    public function edit(string $id): View
    {
        //get berkas_program by ID
        $berkas_program = BerkasProgram::findOrFail($id);

        //render view with berkas_program
        return view('berkas_program.edit', compact('berkas_program'));
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
            'berkas'          => 'required|mimes:pdf,docx|max:2048',
            'judul'          => 'required|min:10',
            'deskripsi'      => 'required|min:10',
            'status'         => 'nullable|min:1'
        ]);

        //get berkas_program by ID
        $berkas_program = BerkasProgram::findOrFail($id);

        //check if image is uploaded
        if ($request->hasFile('berkas')) {

            //upload new image
            $berkas = $request->file('berkas');
            $berkas->storeAs('public/berkas_program', $berkas->hashName());

            //delete old image
            Storage::delete('public/berkas_program/'.$berkas_program->berkas);

            //update berkas_program with new image
            $berkas_program->update([
                'berkas'          => $berkas->hashName(),
                'judul'          => $request->judul,
                'deskripsi'      => $request->deskripsi,
                'status'         => $request->status
            ]);

        } else {

            //update berkas_program without image
            $berkas_program->update([
                'berkas'          => $berkas->hashName(),
                'judul'          => $request->judul,
                'deskripsi'      => $request->deskripsi,
                'status'         => $request->status
            ]);
        }

        //redirect to index
        return redirect()->route('berkas_program.index')->with(['success' => 'Data Berhasil Diubah!']);
    }
    
    /**
     * destroy
     *
     * @param  mixed $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        //get berkas_program by ID
        $berkas_program = BerkasProgram::findOrFail($id);

        //delete image
        Storage::delete('public/berkas_program/'. $berkas_program->document);

        //delete berkas_program
        $berkas_program->delete();

        //redirect to index
        return redirect()->route('berkas_program.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
