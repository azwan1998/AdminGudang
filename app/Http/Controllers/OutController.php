<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Out;
use Illuminate\Http\Request;
use App\Models\Stock;
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
        
        $queries = ['search', 'page'];

        return Inertia::render('Out/Index', [
            'outs' => Out::with('kategori','stock')->filter($request->only($queries))->paginate(4)->withQueryString(),
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
        $stocks = Stock::Latest()->get();
        $kategoris = Kategori::Latest()->get();
        return Inertia::render('Out/Create', compact('stocks','kategoris'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'stock_id' => 'required|integer',
            'kategori_id' => 'required|integer',
            'jumlah' => 'required|string',
        ]);



        $out = $request->user()->outs()->create($request->only('stock_id', 'kategori_id', 'jumlah'));
        $out->stock()->update(['jumlah' => $out->stock->jumlah - $request->jumlah]);

        return redirect()->route('outs.index')->with('success', 'Barang berhasil ditambahkan');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Out  $out
     * @return \Illuminate\Http\Response
     */
    public function show(Out $out)
    {
        return Inertia::render('Out/Show', [
            'outs' => Out::with('stock','kategori')->get(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Out  $out
     * @return \Illuminate\Http\Response
     */
    public function edit(Out $out)
    {
        $stocks = Stock::latest()->get();
        $kategoris = Kategori::latest()->get();
        return Inertia::render('Out/Edit', compact('out', 'stocks', 'kategoris'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Out  $out
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Out $out)
    {
        $request->validate([
            'stock_id' => 'required|integer',
            'kategori_id' => 'required|integer',
            'jumlah' => 'required|integer',
        ]);

        $out->update($request->only('stock_id', 'kategori_id', 'jumlah'));

        return redirect()->route('outs.index')->with('success', 'Barang berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Out  $out
     * @return \Illuminate\Http\Response
     */
    public function destroy(Out $out)
    {
        //
    }
}
