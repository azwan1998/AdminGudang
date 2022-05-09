<?php

namespace App\Http\Controllers;

use App\Models\Incoming;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Stock;
use App\Models\Kategori;
use Illuminate\Support\Facades\DB;

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

        // $stocks = Stock::latest()->get();
        // $kategoris = Kategori::latest()->get();
        return Inertia::render('Incoming/Index', [
            'incomings' => Incoming::with('kategori', 'stock')->filter($request->only($queries))->paginate(2)->withQueryString(),
            'filters' => $request->all($queries),
            // 'stocks' => $stocks,
            // 'kategoris' => $kategoris,
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
        $kategoris = Kategori::latest()->get();
        return Inertia::render('Incoming/Create', compact('stocks','kategoris'));
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
            'kategori_id' => 'required|integer',
            'jumlah' => 'required|string',
        ]);
        // $request->user()->incomings()->create($request->only('stock_id', 'kategori_id', 'jumlah'));
        $incoming = $request->user()->incomings()->create($request->only('stock_id', 'kategori_id', 'jumlah'));
        $incoming->stock()->update(['jumlah' => $incoming->stock->jumlah + $request->jumlah]);
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
        // $stock = Stock::latest()->get();
        // $kategori = Kategori::latest()->get();
        // $incoming = Incoming::with('stock','kategori')->select('kategori.kategori')->get();
        // dd($incoming);
        return Inertia::render('Incoming/Show', [
            'incomings' => Incoming::with('stock','kategori')->get(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Incoming  $incoming
     * @return \Illuminate\Http\Response
     */
    public function edit(Incoming $incoming)
    {
        $stocks = Stock::latest()->get();
        $kategoris = Kategori::latest()->get();
        return Inertia::render('Incoming/Edit', compact('incoming', 'stocks', 'kategoris'));
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
            'stock_id' => 'required|integer',
            'kategori_id' => 'required|integer',
            'jumlah' => 'required|integer',
        ]);

        $incoming->update($request->only('stock_id', 'kategori_id', 'jumlah'));

        return redirect()->route('incomings.index')->with('success', 'Barang berhasil diubah');
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
