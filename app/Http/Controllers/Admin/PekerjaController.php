<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\Admin\PekerjaDataTable;
use App\Models\Pekerja;
use Yajra\DataTables\Facades\DataTables;

class PekerjaController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Pekerja::select('*');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('role', function ($row) {
                    return $row->role->role ?? '-';
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('admin.pekerja.show', $row->id) . '" class="btn btn-sm btn-primary">Detail</a>';
                    $btn .= ' <a href="' . route('admin.pekerja.edit', $row->id) . '" class="btn btn-sm btn-warning">Edit</a>';
                    $btn .= ' <form action="' . route('admin.pekerja.destroy', $row->id) . '" method="POST" style="display:inline-block;">';
                    $btn .= csrf_field();
                    $btn .= method_field('DELETE');
                    $btn .= '<button type="submit" class="btn btn-sm btn-danger" onclick="return confirm(\'Are you sure?\')">Delete</button>';
                    $btn .= '</form>';
                    return $btn;
                })
                ->rawColumns(['role', 'action'])
                ->filterColumn("role", function ($query, $value) {
                    $query->whereHas("role", fn($q) => $q->where("role", "LIKE", "%$value%"));
                })
                ->make(true);
        }
        return view('pages.admin.pekerja.index');
    }

    public function create()
    {
        return view('pages.admin.pekerja.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:pekerja,email',
            'telepon' => 'required|string|max:15',
            'alamat' => 'nullable|string|max:255',
        ]);

        Pekerja::create($request->all());

        return redirect()->route('admin.pekerja.index')->with('success', 'Pekerja created successfully.');
    }
    public function show($id)
    {
        $pekerja = Pekerja::findOrFail($id);
        return view('pages.admin.pekerja.show', compact('pekerja'));
    }
    public function edit($id)
    {
        $pekerja = Pekerja::findOrFail($id);
        return view('pages.admin.pekerja.edit', compact('pekerja'));
    }
    public function update(Request $request, $id)
    {
        $pekerja = Pekerja::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:pekerja,email,' . $pekerja->id,
            'telepon' => 'required|string|max:15',
            'alamat' => 'nullable|string|max:255',
        ]);

        $pekerja->update($request->all());

        return redirect()->route('admin.pekerja.index')->with('success', 'Pekerja updated successfully.');
    }
    public function destroy($id)
    {
        $pekerja = Pekerja::findOrFail($id);
        $pekerja->delete();

        return redirect()->route('admin.pekerja.index')->with('success', 'Pekerja deleted successfully.');
    }
}
