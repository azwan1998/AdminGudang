<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;
use Illuminate\Database\Seeder\DB;

class KategoriTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kategori = new Kategori;
        $kategori->kategori = "Laptop";
        $kategori->user_id = 1;
        $kategori->save();

        $kategori2 = new Kategori;
        $kategori2->kategori = "Mouse";
        $kategori2->user_id = 1;
        $kategori2->save();

        $kategori3 = new Kategori;
        $kategori3->kategori = "LCD";
        $kategori3->user_id = 1;
        $kategori3->save();

        $kategori4 = new Kategori;
        $kategori4->kategori = "RAM";
        $kategori4->user_id = 1;
        $kategori4->save();
    }
}
