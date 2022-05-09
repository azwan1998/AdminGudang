<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Inertia\Inertia;


class KategoriController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(kategori::class);
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

        return Inertia::render('Kategori/Index', [
            'kategoris' => Kategori::filter($request->only($queries))->paginate(2)->withQueryString(),
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
        return Inertia::render('Kategori/Create');
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
            'kategori' => 'required|string',
        ]);

        // kategori::create($request->only('nama_barang', 'kategori', 'merk', 'jumlah'));
        $request->user()->kategoris()->create($request->only('kategori'));

        return redirect()->route('kategoris.index')->with('success', 'Kategori berhasil ditambahkan');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function show(kategori $kategori)
    {
        return Inertia::render('kategori/Show', compact('kategori'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function edit(Kategori $kategori)
    {
        return Inertia::render('Kategori/Edit', compact('kategori'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kategori $kategori)
    {
        $request->validate([
            'kategori' => 'required|string',
        ]);

        $kategori->update($request->only('kategori'));

        return redirect()->route('kategoris.index')->with('success', 'Barang berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function destroy(kategori $kategori)
    {
        $kategori->delete();

        return back();
    }
}
