<?php

namespace App\Http\Controllers\Afdeling;

use App\Http\Controllers\Controller;
use App\Http\Requests\PengangkutanRequest;
use App\Models\Pengangkutan;
use App\Models\PengangkutanHasilPanen;
use App\Models\RefBlok;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class JadwalOperasionalController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Pengangkutan::where('user_id', auth()->user()->id)->where('status', '!=', 'selesai');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function ($row) {
                    switch ($row->status) {
                        case 'persiapan':
                            $status = ' <button type="button" data-id=' . $row->id . ' class="btn btn-sm btn-primary" data-status="proses" id="btn-status">Proses</button>';
                            break;
                        case 'proses':
                            $status = ' <button type="button" data-id=' . $row->id . ' data-status="selesai" class="btn btn-sm btn-success" id="btn-status">Selesai</button>';
                            break;
                        default:
                            $status = ' <button type="button" data-id=' . $row->id . ' data-status="proses" class="btn btn-sm btn-primary" id="btn-status">Proses</button>';
                            break;
                    }
                    return $status;
                })
                ->addColumn('action', function ($row) {
                    $btn = ' <a href="' . route('afdeling.jadwal-operasional.edit', $row->id) . '" class="btn btn-sm btn-warning">Edit</a>';
                    $btn .= '<button type="button" data-id="' . $row->id . '" id="delete" class="ms-2 btn btn-sm btn-danger">Hapus</button>';
                    return $btn;
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }
        return view('pages.afdeling.jadwal-operasional.index');
    }

    public function create()
    {
        $blok = RefBlok::all();
        return view('pages.afdeling.jadwal-operasional.create', compact('blok'));
    }

    public function store(PengangkutanRequest $request)
    {
        try {
            do {
                $kode_pengangkutan = 'PGK-' . str_pad(random_int(1, 9999), 4, '0', STR_PAD_LEFT);
            } while (Pengangkutan::where('kode_pengangkutan', $kode_pengangkutan)->exists());

            $validatedData = $request->validated();
            $validatedData['kode_pengangkutan'] = $kode_pengangkutan;
            $validatedData['user_id'] = auth()->user()->id;
            $validatedData['status'] = 'persiapan';

            Pengangkutan::create($validatedData);

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil disimpan!',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function edit($id)
    {
        $pengangkutan = Pengangkutan::findOrFail($id);
        $blok = RefBlok::all();
        return view('pages.afdeling.jadwal-operasional.edit', compact('pengangkutan', 'blok'));
    }

    public function update(PengangkutanRequest $request, $id)
    {
        try {
            $pengangkutan = Pengangkutan::findOrFail($id);
            $pengangkutan->update($request->validated());
            return response()->json([
                'success' => true,
                'message' => 'Data berhasil diubah!',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
    public function updateStatus($id, $status)
    {
        try {
            $pengangkutan = Pengangkutan::findOrFail($id);
            $pengangkutan->update(['status' => $status]);
            return response()->json([
                'success' => true,
                'message' => 'Data berhasil diubah!',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $pengangkutan = Pengangkutan::findOrFail($id);
            $pengangkutan->delete();
            return response()->json([
                'success' => true,
                'message' => 'Data berhasil dihapus!',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}
