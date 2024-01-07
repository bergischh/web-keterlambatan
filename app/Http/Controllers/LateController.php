<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Excel;
use App\Models\Late;
use App\Models\Student;
use App\Exports\ExportLate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $late = Late::with('student');

        if ($request->has('search')) {
            $searchTerm = $request->get('search');
            $late->whereHas('student', function ($query) use ($searchTerm) {
                $query->where('name', 'like', '%' . $searchTerm . '%');
            });
        }

        $late = $late->simplePaginate(5);

        return view('admin.late.index', compact('late'));
    }

    public function recap()
    {
        $late = Late::with('student')
            ->selectRaw('siswa_id, COUNT(*) as total_late') // Menghitung total keterlambatan
            ->groupBy('siswa_id') // Mengelompokkan data berdasarkan ID siswa
            ->simplePaginate(5);

        return view('admin.late.recap', compact('late'));
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
    public function create()
    {
        $student = Student::all();
        return view('admin.late.create', compact('student'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required',
            'date_time_late' => 'required',
            'information' => 'required',
            'bukti' => 'required|mimes:png,jpg,jpeg|max:2048',
        ]);

        $lateData = [
            'siswa_id' => $request->siswa_id,
            'date_time_late' => $request->date_time_late,
            'information' => $request->information,
        ];
        
        if ($request->file('bukti')->isValid()) {
            $file = $request->file('bukti');
            $path = $file->store('photouser', 'public');

            $lateData ['bukti'] = $path;
        }

        Late::create($lateData);

        return redirect()->route('late.index')->with('success', 'Berhasil menambah data!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $late = Late::find($id)->first();        
        return view('admin.late.print', compact('late'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $student = Student::all();
        $late = Late::with('student')->find($id);

        return view('admin.late.edit', compact('late', 'student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'siswa_id' => 'required',
            'date_time_late' => 'required',
            'information' => 'required',
            'bukti' => 'sometimes|mimes:png,jpg,jpeg|max:2048', 
        ]);
    
        // Mengambil data terlambat berdasarkan ID
        $late = Late::findOrFail($id);
    
        $lateData = [
            'siswa_id' => $request->siswa_id,
            'date_time_late' => $request->date_time_late,
            'information' => $request->information,
        ];
    
        if ($request->hasFile('bukti') && $request->file('bukti')->isValid()) {
            // Menghapus gambar lama jika ada
            if ($late->bukti) {
                Storage::disk('public')->delete($late->bukti);
            }
    
            // Mengunggah gambar baru
            $file = $request->file('bukti');
            $path = $file->store('photouser', 'public');
    
            // Menyimpan path gambar baru ke dalam data yang akan diperbarui
            $lateData['bukti'] = $path;
        }
    
        // Memperbarui data terlambat dengan data yang baru
        $late->update($lateData);
    

        return redirect()->route('late.index')->with('success', 'Berhasil mengubah data!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $late = Late::find($id);

        if ($late->bukti) {
            Storage::disk('public')->delete($late->bukti);
        }
    
        $late->delete();
    
        return redirect()->back()->with('deleted', 'Berhasil menghapus data!');
    }

    public function exportExcel() {
        $fileName = 'data_keterlambatan.xlsx';
        return Excel::download(new ExportLate, $fileName);
    }

    public function downloadPDF($id) {
        $late = Late::find($id)->toArray();
        view()->share('late',$late); 
        $pdf = PDF::loadView('admin.late.download-pdf', compact('late'));
        return $pdf->download('Surat Pernyataan Terlambat.pdf');
    }

}
