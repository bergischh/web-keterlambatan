<?php

namespace App\Http\Controllers;

use App\Models\Late;
use App\Models\Rayon;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PsLateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user_id = Auth::user()->id;

        $rayon_id = Rayon::where('user_id', $user_id)->value('id');
    
        if ($rayon_id) {
            $studentsInRayon = Student::where('rayon_id', $rayon_id)->get();
    
            $studentIds = $studentsInRayon->pluck('id')->toArray();
    
            $query = Late::whereIn('siswa_id', $studentIds)
                ->with('student.rombel', 'student.rayon');
    
            $search = $request->input('search');
            if (!empty($search)) {
                $query->whereHas('student', function ($queryy) use ($search) {
                    $queryy->where('name', 'LIKE', '%' . $search . '%');
                });
            }
    
            $late = $query->simplePaginate(10);
    
            return view('ps.late.index', compact('late', 'search'));
        }
    
        return redirect()->route('ps.late.recap')->with('gagal', 'Data keterlambatan siswa tidak ditemukan');
    }
    
    public function recap()
    {
        $user_id = Auth::user()->id;
    
        $rayon_id = Rayon::where('user_id', $user_id)->value('id');
    
        if ($rayon_id) {
            $studentsInRayon = Student::where('rayon_id', $rayon_id)->get();
    
            $studentIds = $studentsInRayon->pluck('id')->toArray();
    
            $late = Late::whereIn('siswa_id', $studentIds)
                ->with('student')
                ->selectRaw('siswa_id, COUNT(*) as total_late')
                ->groupBy('siswa_id')
                ->simplePaginate(5);
    
            return view('ps.late.recap', compact('late'));
        }
    
        return redirect()->route('ps.late.recap')->with('gagal', 'Data keterlambatan siswa tidak ditemukan');
    }
    

    public function detail(string $siswa_id) {
        $late = Late::with('student')->where('siswa_id', $siswa_id)->orderBy('date_time_late', 'asc')->get();
        $siswa = Student::with('rombel', 'rayon')->find($siswa_id);
        if ($late->isEmpty()) {
            return redirect()->route('admin.late.recap')->with('gagal', 'Data tidak dapat ditemukan' . $siswa_id);
        }
        return view('admin.late.detail', compact('late', 'siswa'));
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {

    // }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {

    // }

    /**
     * Display the specified resource.
     */
    public function show(Late $late)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit($id)
    // {

    // }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, $id)
    // {

    // }

    /**
     * Remove the specified resource from storage.
     */
}
