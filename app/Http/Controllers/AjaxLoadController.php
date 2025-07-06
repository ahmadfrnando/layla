<?php

namespace App\Http\Controllers;

use App\Http\Requests\KaryawanRequest;
use App\Models\Karyawan;
use Illuminate\Http\Request;

class AjaxLoadController extends Controller
{
    public function getKodePengangkutan(Request $request)
    {
        $searchTerm = $request->input('q');  // Ambil query parameter 'q'

        // Lakukan pencarian berdasarkan kode_pengangkutan yang cocok dengan query
        $pengangkutan = \App\Models\Pengangkutan::where('status', 'selesai')->whereDoesntHave('pengangkutanHasilPanen')
            ->where('kode_pengangkutan', 'LIKE', '%' . $searchTerm . '%')  // Filter berdasarkan kata kunci
            ->get(['id', 'kode_pengangkutan'])  // Ambil hanya kolom id dan kode_pengangkutan
            ->toArray();

        // Format respons agar sesuai dengan struktur yang diinginkan oleh select2
        // $formattedData = array_map(function ($item) {
        //     return [
        //         'id' => $item['id'],
        //         'text' => $item['kode_pengangkutan']
        //     ];
        // }, $pengangkutan);

        return response()->json($pengangkutan);  // Kembalikan sebagai JSON
    }

    public function getKaryawan(Request $request)
    {
        $searchTerm = $request->input('q');  // Ambil query parameter 'q'

        // Lakukan pencarian berdasarkan kode_pengangkutan yang cocok dengan query
        $karyawan = \App\Models\Karyawan::where('nama', 'LIKE', '%' . $searchTerm . '%')  // Filter berdasarkan kata kunci
            ->get(['id', 'nama'])  // Ambil hanya kolom id dan kode_pengangkutan
            ->toArray();

        // Format respons agar sesuai dengan struktur yang diinginkan oleh select2
        // $formattedData = array_map(function ($item) {
        //     return [
        //         'id' => $item['id'],
        //         'text' => $item['kode_pengangkutan']
        //     ];
        // }, $pengangkutan);

        return response()->json($karyawan);  // Kembalikan sebagai JSON
    }

    public function getSupir(Request $request)
    {
        $searchTerm = $request->input('q');  // Ambil query parameter 'q'

        // Lakukan pencarian berdasarkan kode_pengangkutan yang cocok dengan query
        $supir = \App\Models\Supir::where('nama', 'LIKE', '%' . $searchTerm . '%')  // Filter berdasarkan kata kunci
            ->get(['id', 'nama'])  // Ambil hanya kolom id dan kode_pengangkutan
            ->toArray();

        // Format respons agar sesuai dengan struktur yang diinginkan oleh select2
        // $formattedData = array_map(function ($item) {
        //     return [
        //         'id' => $item['id'],
        //         'text' => $item['kode_pengangkutan']
        //     ];
        // }, $supir);

        return response()->json($supir);  // Kembalikan sebagai JSON
    }

    public function getKaryawanPengguna(Request $request)
    {
        $searchTerm = $request->input('q');

        $karyawan = \App\Models\Karyawan::where('user_id', null )->where('nama', 'LIKE', '%' . $searchTerm . '%')  // Filter berdasarkan kata kunci
            ->get(['id', 'nama'])  // Ambil hanya kolom id dan kode_pengangkutan
            ->toArray();

        return response()->json($karyawan);
    }
}
