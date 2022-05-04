<?php

namespace App\Http\Controllers;

use App\Models\Incoming;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Stock;

class IncomingController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Incoming::class);
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

        return Inertia::render('Incoming/Index', [
            'incomings' => Incoming::filter($request->only($queries))->paginate(4)->withQueryString(),
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
        $stocks = Stock::latest()->get();
        return Inertia::render('Incoming/Create', [
            'stocks' => $stocks
         ]);
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
            'stock_id' => 'required|integer',
            'kategori' => 'required|string',
            'jumlah' => 'required|string',
        ]);

        // Incoming::create($request->only('nama_barang', 'kategori', 'merk', 'jumlah'));
        $request->user()->incomings()->create($request->only('stock_id', 'kategori', 'jumlah'));

        return redirect()->route('incomings.index')->with('success', 'Barang berhasil ditambahkan');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Incoming  $incoming
     * @return \Illuminate\Http\Response
     */
    public function show(Incoming $incoming)
    {
        return Inertia::render('Incoming/Show', compact('incoming'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Incoming  $incoming
     * @return \Illuminate\Http\Response
     */
    public function edit(Incoming $incoming)
    {
        return Inertia::render('Incoming/Edit', compact('incoming'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Incoming  $incoming
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Incoming $incoming)
    {
        $request->validate([
            'nama_barang' => 'required|string',
            'kategori' => 'required|string',
            'merk' => 'required|string',
            'jumlah' => 'required|integer',
        ]);

        $incoming->update($request->only('nama_barang', 'kategori', 'merk', 'jumlah'));

        return back()->with('success', 'Barang berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Incoming  $incoming
     * @return \Illuminate\Http\Response
     */
    public function destroy(Incoming $incoming)
    {
        $incoming->delete();

        return back();
    }
}
