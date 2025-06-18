<?php

namespace App\Http\Controllers\Afdeling;

use App\Http\Controllers\Controller;
use App\Models\Supir;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SupirController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Supir::select('*');
            return DataTables::of($data)
                ->addIndexColumn()
                ->make(true);
        }
        return view('pages.afdeling.supir.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
