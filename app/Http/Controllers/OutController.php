<?php

namespace App\Http\Controllers;

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
            'outs' => Out::filter($request->only($queries))->paginate(4)->withQueryString(),
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
        return Inertia::render('Out/Create', ['stocks' => $stocks]);
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
            'nama_barang' => 'required|string',
            'kategori' => 'required|string',
            'merk' => 'required|string',
            'jumlah' => 'required|string',
        ]);

        // Incoming::create($request->only('nama_barang', 'kategori', 'merk', 'jumlah'));
        $request->user()->outs()->create($request->only('nama_barang', 'kategori', 'merk', 'jumlah'));

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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Out  $out
     * @return \Illuminate\Http\Response
     */
    public function edit(Out $out)
    {
        //
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
        //
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
