<?php

namespace App\Http\Controllers;

use App\Models\Rayon;
use App\Models\Rombel;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     $student = Student::with('rombel', 'rayon')->simplePaginate(10);

    //     return view('admin.siswa.index', compact('student'));
    // }

    public function index(Request $request)
    {
        $search = $request->input('search');

        $student = Student::with('rombel', 'rayon')
            ->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhereHas('rombel', function ($query) use ($search) {
                        $query->where('rombel', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('rayon', function ($query) use ($search) {
                        $query->where('rayon', 'like', '%' . $search . '%');
                    });
            })
            ->simplePaginate(5);

        return view('admin.siswa.index', compact('student'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $rombel = Rombel::all();
        $rayon = Rayon::all();
        return view('admin.siswa.create', compact('rombel', 'rayon'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nis' => 'required|min:8',
            'name' => 'required',
            'rombel_id' => 'required',
            'rayon_id' => 'required',

        ]);

        Student::create([
            'nis' => $request->nis,
            'name' => $request->name,
            'rombel_id' => $request->rombel_id,
            'rayon_id' => $request->rayon_id,
        ]);

        return redirect()->route('siswa.index')->with('success', 'Berhasil menambah data!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $rombel = Rombel::all();
        $rayon = Rayon::all();
        $student = Student::with('rombel', 'rayon')->find($id);

        return view('admin.siswa.edit', compact('student', 'rombel', 'rayon'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nis' => 'required|min:8',
            'name' => 'required',
            'rombel_id' => 'required',
            'rayon_id' => 'required',
        ]);

        Student::where('id', $id)->update([
            'nis' => $request->nis,
            'name' => $request->name,
            'rombel_id' => $request->rombel_id,
            'rayon_id' => $request->rayon_id,
        ]);


        return redirect()->route('siswa.index')->with('success', 'Berhasil mengubah data!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Student::where('id', $id)->delete();

        return redirect()->back()->with('deleted', 'Berhasil menghapus data!');
    }
}
