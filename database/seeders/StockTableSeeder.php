<?php

namespace Database\Seeders;

use App\Models\Stock;
use Illuminate\Database\Seeder;

class StockTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $stock = new Stock;
        $stock->nama_barang = "HP Omen Zhyprus Neptunus N70";
        $stock->kategori_id = 1;
        $stock->merk = "HP";
        $stock->jumlah = 10;
        $stock->user_id = 1;
        $stock->save();

        $stock2 = new Stock;
        $stock2->nama_barang = "LG OLED 8K";
        $stock2->kategori_id = 3;
        $stock2->merk = "LG";
        $stock2->jumlah = 11;
        $stock2->user_id = 1;
        $stock2->save();
    }
}
