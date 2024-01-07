<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {                
        $search = $request->input('search'); // Mengambil nilai pencarian dari input form
        $user = User::when($search, function ($query) use ($search) {
            return $query->where('name', 'like', '%'.$search.'%'); // Menggunakan 'nama' sebagai contoh kolom yang dicari
        })->paginate(10);

    
        return view('admin.user.index', compact('user'));
    }

    public function dashboard()
    {
        $totalStudents = App\models\Rayon::where('id', '!=', '')->count();
        $totalLate = App\models\Attendance::where('status', 'Late')->count();

        return view('ps.pshome', compact('totalStudents', 'totalLate'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
            'role' => 'required'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make(substr($request->email, 0, 3) . substr($request->nama, 0, 3))
        ]);

        return redirect()->route('user.index')->with('success', 'Berhasil Menambahkan Akun!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id); //User::where('id', $id)->first()

        return view('admin.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
            'role' => 'required'
        ]);

        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ];

        if ($request->filled('password')) {
            $userData['password'] = Hash::make($request->password);
        }

        User::where('id', $id)->update($userData);

        return redirect()->route('user.index')->with('success', 'Berhasil mengubah data!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        User::where('id', $id)->delete();

        return redirect()->back()->with('deleted', 'Berhasil menghapus data!');
    }

    public function loginAuth(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ],[
            'email.required' => 'Email harus diisi',
            'email.email' => 'Email tidak valid',
            'password.required' => 'Password harus diisi',
            'password.alpha_dash' => 'Password harus berisi huruf dan karakter tanpa spasi'
        ]);

        $user = $request->only(['email', 'password']);

        if (Auth::attempt($user)) {
            if (Auth::user()->role === 'administrator') {
                return redirect()->route('home');
            } elseif (Auth::user()->role === 'pembimbingsiswa') {
                return redirect()->route('pshome');
            }
        } else {
            return redirect()->back()->with('failed', 'Proses login gagal, silahkan coba kembali data yang benar');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('logout', 'Anda telah logout');
    }
}
