<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MataKuliah;
// Asumsi Anda akan membuat MatakuliahResource untuk formatting response
use App\Http\Resources\MatakuliahResource; 
use Illuminate\Support\Facades\Validator;

class MatakuliahController extends Controller
{
    //TODO ( Praktikan Nomor Urut 5 )
    // Tambahkan fungsi index yang akan menampilkan List Data Matakuliah
    public function index()
    {
        $matakuliahs = MataKuliah::latest()->paginate(10);
        return new MatakuliahResource(true, 'List Data Matakuliah', $matakuliahs);
    }
    public function show($id)
    {
        $matakuliah = MataKuliah::find($id);

        if (!$matakuliah) {
            return response()->json(['message' => 'Mata Kuliah tidak ditemukan'], 404);
        }

        return new MatakuliahResource(true, 'Detail Data Matakuliah!', $matakuliah);
    }


    //TODO ( Praktikan Nomor Urut 6 )
    // Tambahkan fungsi store yang akan menyimpan data MataKuliah baru
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string',
            'kode' => 'required|string|unique:mata_kuliahs,kode',
            'sks' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $matakuliah = MataKuliah::create($request->all());

        return new MatakuliahResource(true, 'Data Matakuliah Berhasil Ditambahkan!', $matakuliah);
    }

    //TODO ( Praktikan Nomor Urut 7 )
    // Tambahkan fungsi update yang mengubah data MataKuliah yang dipilih
    public function update(Request $request, $id)
    {
        $matakuliah = MataKuliah::find($id);

        if (!$matakuliah) {
            return response()->json(['message' => 'Mata Kuliah tidak ditemukan'], 404);
        }

        // Validasi, kode harus unique kecuali kode milik data ini
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string',
            'kode' => 'required|string|unique:mata_kuliahs,kode,' . $id, 
            'sks' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $matakuliah->update($request->all());

        return new MatakuliahResource(true, 'Data Matakuliah Berhasil Diubah!', $matakuliah);
    }

    //TODO ( Praktikan Nomor Urut 8 )
    // Tambahkan fungsi destroy yang akan menghapus data MataKuliah yang dipilih
    public function destroy($id)
    {
        $matakuliah = MataKuliah::find($id);

        if (!$matakuliah) {
            return response()->json(['message' => 'Mata Kuliah tidak ditemukan'], 404);
        }

        $matakuliah->delete();

        return new MatakuliahResource(true, 'Data Matakuliah Berhasil Dihapus!', null);
    }
}