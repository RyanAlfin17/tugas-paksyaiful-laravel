<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;


use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Project;
use App\Models\Contact;

class MasterSiswaController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin')->except('index');
    }
    public function index()
    {
        $siswaList = Siswa::with('projects', 'Contact')->get();
        return view('admin.mastersiswa', compact('siswaList'));
    }

    public function tambah()
    {
        return view('admin.tambahsiswa');
    }

    public function store(Request $request)
    {
        // Validasi data dari form
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'about' => 'required',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Sesuaikan dengan kebutuhan
        ]);

        // Simpan data ke database
        $siswa = new Siswa;
        $siswa->name = $validatedData['name'];
        $siswa->about = $validatedData['about'];

        // Simpan foto dengan nama yang diacak
        $file = $request->file('photo');
        $file_extension = $file->getClientOriginalExtension(); // Dapatkan ekstensi file
        $file_name = uniqid() . '.' . $file_extension; // Nama file diacak
        $path = $request->file('photo')->storeAs('public/photos', $file_name); // Simpan file dengan nama acak
        $siswa->photo = $file_name;

        $siswa->save();

        return redirect()->route('mastersiswa')->with('success', 'Data siswa berhasil ditambahkan.');
    }



    public function edit($id)
    {
        $siswa = Siswa::find($id);
        if (!$siswa) {
            return redirect()->route('mastersiswa')->with('error', 'Siswa tidak ditemukan');
        }

        return view('admin.editsiswa', compact('siswa'));
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'about' => 'nullable|string',
            'new_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Customize as needed
        ]);

        $siswa = Siswa::find($id);
        if (!$siswa) {
            // Handle if the student is not found
            return redirect()->route('editsiswa')->with('error', 'Siswa tidak ditemukan');
        }

        $siswa->name = $request->input('name');
        $siswa->about = $request->input('about');

        if ($request->hasFile('new_photo')) {
            $newPhoto = $request->file('new_photo');
            $newPhotoName = uniqid() . '.' . $newPhoto->getClientOriginalExtension();
            $newPhoto->storeAs('public/photos', $newPhotoName);
            $siswa->photo = $newPhotoName;
        }

        $siswa->save();

        return redirect()->route('mastersiswa')->with('success', 'Data siswa berhasil diperbarui');
    }



    public function delete($id)
    {
        Siswa::destroy($id);
        return redirect()->route('mastersiswa')->with('message', 'Data berhasil dihapus');
    }
}
