<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stock;
use App\Models\Incoming;
use App\Models\Kategori;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class StockController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Incoming::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * 
     */
    
    public function index(Request $request)
    {
        // $stocks =Stock::latest()->get();
        // $kategoris = DB::table('stocks')
        //             ->leftJoin('kategoris','kategoris.id','=','stocks.kategori_id')
        //             ->select('kategoris.kategori')
        //             ->get();
        // $kategoris = Kategori::with('stocks')->get();

        // dd($kategoris);
        // $stocks->setAttribut('stocks',$stock);
        $queries = ['search', 'page'];
        return Inertia::render('Stock/Index', [
            'stocks' => Stock::with('kategori')->filter($request->only($queries))->paginate(2)->withQueryString(),
            'filters' => $request->all($queries),
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
        $kategoris = Kategori::Latest()->get();
        return Inertia::render('Stock/Create', compact('kategoris'));
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
            'kategori_id' => 'required|integer',
            'merk' => 'required|string',
            'jumlah' => 'required|string',
        ]);

        // Incoming::create($request->only('nama_barang', 'kategori', 'merk', 'jumlah'));
        $request->user()->stocks()->create($request->only('nama_barang', 'kategori_id', 'merk', 'jumlah'));

        return redirect()->route('stocks.index')->with('success', 'Barang berhasil ditambahkan');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Incoming  $incoming
     * @return \Illuminate\Http\Response
     */
    public function show(Stock $stock)
    {
        return Inertia::render('Stock/Show', compact('stock'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Incoming  $incoming
     * @return \Illuminate\Http\Response
     */
    public function edit(Stock $stock)
    {
        $kategoris = Kategori::latest()->get();
        return Inertia::render('Stock/Edit', compact('stock', 'kategoris'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Incoming  $incoming
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Stock $stock)
    {
        $request->validate([
            'nama_barang' => 'required|string',
            'kategori_id' => 'required|integer',
            'merk' => 'required|string',
            'jumlah' => 'required|integer',
        ]);

        $stock->update($request->only('nama_barang', 'kategori_id', 'merk', 'jumlah'));

        return redirect()->route('stocks.index')->with('success', 'Barang berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Incoming  $incoming
     * @return \Illuminate\Http\Response
     */
    // public function destroy(Incoming $incoming)
    // {
    //     $incoming->delete();

    //     return back();
    // }
}
