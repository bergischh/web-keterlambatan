<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Rayon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RayonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $rayon = Rayon::with('user');
                
        if ($request->has('search')) {
            $searchTerm = $request->get('search');
            $rayon->whereHas('user', function ($query) use ($searchTerm) {
                $query->where('name', 'like', '%' . $searchTerm . '%');
            });
        }
    
        $rayon = $rayon->simplePaginate(5);
    
        return view('admin.rayon.index', compact('rayon'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = User::all();
        return view('admin.rayon.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'rayon' => 'required',
            'user_id' => 'required',
        ]);

        Rayon::create([
            'rayon' => $request->rayon,
            'user_id' => $request->user_id,
        ]);

        return redirect()->route('rayon.index')->with('success', 'Berhasil menambah data!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Rayon $rayon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::all();
        $rayon = Rayon::with('user')->find($id);

        return view('admin.rayon.edit', compact('rayon', 'user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'rayon' => 'required|min:3',
            'user_id' => 'required',
        ]);

        Rayon::where('id', $id)->update([
            'rayon' => $request->rayon,
            'user_id' => $request->user_id,
        ]);


        return redirect()->route('rayon.index')->with('success', 'Berhasil mengubah data!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Rayon::where('id', $id)->delete();

        return redirect()->back()->with('deleted', 'Berhasil menghapus data!');
    }
}
