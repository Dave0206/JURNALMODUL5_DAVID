<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Http\Resources\MahasiswaResource; 
use Illuminate\Support\Facades\Validator;

class MahasiswaController extends Controller
{
    //TODO ( Praktikan Nomor Urut 1 )
    // Tambahkan fungsi index yang akan menampilkan List Data Mahasiswa
    public function index()
    {
        $mahasiswas = Mahasiswa::latest()->paginate(10);
        return new MahasiswaResource(true, 'List Data Mahasiswa', $mahasiswas);
    }
    
    // dan fungsi show yang akan menampilkan Detail Data Mahasiswa yang dipilih
    public function show($id)
    {
        $mahasiswa = Mahasiswa::find($id);

        if (!$mahasiswa) {
            return response()->json(['message' => 'Mahasiswa tidak ditemukan'], 404);
        }

        return new MahasiswaResource(true, 'Detail Data Mahasiswa!', $mahasiswa);
    }

    //TODO ( Praktikan Nomor Urut 2 )
    // Tambahkan fungsi store yang akan menyimpan data Mahasiswa baru
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string',
            'nim' => 'required|string|unique:mahasiswas,nim',
            'jurusan' => 'required|string',
            'fakultas' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $mahasiswa = Mahasiswa::create($request->all());

        return new MahasiswaResource(true, 'Data Mahasiswa Berhasil Ditambahkan!', $mahasiswa);
    }

    //TODO ( Praktikan Nomor Urut 3 )
    // Tambahkan fungsi update yang mengubah data Mahasiswa yang dipilih
    public function update(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::find($id);

        if (!$mahasiswa) {
            return response()->json(['message' => 'Mahasiswa tidak ditemukan'], 404);
        }

        // Validasi, nim harus unique kecuali nim milik data ini
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string',
            'nim' => 'required|string|unique:mahasiswas,nim,' . $id, 
            'jurusan' => 'required|string',
            'fakultas' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $mahasiswa->update($request->all());

        return new MahasiswaResource(true, 'Data Mahasiswa Berhasil Diubah!', $mahasiswa);
    }

    //TODO ( Praktikan Nomor Urut 4 )
    // Tambahkan fungsi destroy yang akan menghapus data Mahasiswa yang dipilih
    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::find($id);

        if (!$mahasiswa) {
            return response()->json(['message' => 'Mahasiswa tidak ditemukan'], 404);
        }

        $mahasiswa->delete();

        return new MahasiswaResource(true, 'Data Mahasiswa Berhasil Dihapus!', null);
    }
}