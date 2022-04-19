<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\BarangMasuk;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BarangMasukController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(BarangMasuk::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return Inertia::render('barang_masuk/Index');

        // $queries = ['search', 'page'];
        // return Inertia::render('barang_masuk/Index', [
        //     'posts' => Post::filter($request->only($queries))->paginate(2)->withQueryString(),
        //     'filters' => $request->all($queries),
        // ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('barang_masuk/Create');
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
            'jumlah' => 'required|integer',
            'merk' => 'required|string'
        ]);

        $request->user()->posts()->create($request->only('nama_barang', 'kategori','jumlah','merk'));

        return redirect()->route('bMasuk.index')->with('success', 'Barang berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(BarangMasuk $barangMasuk)
    {
        return Inertia::render('BarangMasuk/Edit', compact('BarangMasuk'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            '' => 'required|string',
            'content' => 'required|string'
        ]);

        $post->update($request->only('title', 'content'));

        return back()->with('success', 'Post berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return back()->with('success', 'Post Berhasil Dihapus');
    }
}
