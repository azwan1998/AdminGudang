<?php

namespace App\Http\Controllers;

use App\Models\Out;
use Illuminate\Http\Request;
use Inertia\Inertia;

class OutController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Out::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // dd($request);
        $queries = ['search', 'page'];

        return Inertia::render('Out/Index', [
            'Outs' => Out::filter($request->only($queries))->paginate(4)->withQueryString(),
            'filters' => $request->all($queries),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Out/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'nama_barang' => 'required|string',
            'kategori' => 'required|string',
            'merk' => 'required|string',
            'jumlah' => 'required|string',
        ]);

        // Out::create($request->only('nama_barang', 'kategori', 'merk', 'jumlah'));
        $request->user()->ComeOuts()->create($request->only('nama_barang', 'kategori', 'merk', 'jumlah'));

        return redirect()->route('Outs.index')->with('success', 'Barang berhasil ditambahkan');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Out  $Out
     * @return \Illuminate\Http\Response
     */
    public function show(Out $out)
    {
        return Inertia::render('Out/Show', compact('out'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Out  $Out
     * @return \Illuminate\Http\Response
     */
    public function edit(Out $out)
    {
        return Inertia::render('Out/Edit', compact('out'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Out  $Out
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Out $out)
    {
        $request->validate([
            'nama_barang' => 'required|string',
            'kategori' => 'required|string',
            'merk' => 'required|string',
            'jumlah' => 'required|integer',
        ]);

        $Out->update($request->only('nama_barang', 'kategori', 'merk', 'jumlah'));

        return back()->with('success', 'Barang berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Out  $Out
     * @return \Illuminate\Http\Response
     */
    public function destroy(Out $out)
    {
        $Out->delete();

        return back();
    }
}
