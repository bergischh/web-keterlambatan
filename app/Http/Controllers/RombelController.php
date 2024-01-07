<?php

namespace App\Http\Controllers;

use App\Models\Rombel;
use Illuminate\Http\Request;

class RombelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {                
        $search = $request->input('search'); // Mengambil nilai pencarian dari input form
        $rombel = Rombel::when($search, function ($query) use ($search) {
            return $query->where('rombel', 'like', '%'.$search.'%'); // Menggunakan 'nama' sebagai contoh kolom yang dicari
        })->paginate(10);

    
        return view('admin.rombel.index', compact('rombel'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.rombel.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate ([
            'rombel' => 'required|min:3',
        ]);

        Rombel::create([
            'rombel' => $request->rombel,
        ]);

        return redirect()->route('rombel.index')->with('success', 'Berhasil Menambahkan Akun!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Rombel $rombel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $rombel = Rombel::find($id);

        return view('admin.rombel.edit', compact('rombel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate ([
            'rombel' => 'required|min:3',
        ]);

        Rombel::where ('id', $id)->update ([
            'rombel' => $request->rombel,
        ]);

        return redirect()->route('rombel.index')->with('Success', 'Berhasil Mengubah Data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Rombel::where('id', $id)->delete();

        return redirect()->back()->with('deleted', 'Berhasil menghapus data!');
    }
}
