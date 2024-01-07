<?php

namespace App\Http\Controllers;

use App\Models\Rayon;
use App\Models\Rombel;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PsStudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $id = Auth::user()->id;

        $rayon = Rayon::where('user_id', $id)->first();
    
        if ($rayon) {
            $query = Student::where('rayon_id', $rayon->id)->with('rombel', 'rayon');

            // Pencarian (search)
            $search = $request->input('search');
            if (!empty($search)) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhereHas('rombel', function ($query) use ($search) {
                        $query->where('rombel', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('rayon', function ($query) use ($search) {
                        $query->where('rayon', 'like', '%' . $search . '%');
                    });
            }

            $student = $query->simplePaginate(10);

            return view('ps.siswa.index', compact('student', 'search'));
        } else {
            return redirect()->route('ps.siswa.index')->with('gagal', 'Data siswa tidak ditemukan');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
}
