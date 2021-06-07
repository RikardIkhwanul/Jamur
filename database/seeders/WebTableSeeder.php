<?php

namespace Database\Seeders;

use App\Models\Web;
use Illuminate\Database\Seeder;

class WebTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Web::truncate();
        Web::create([
            'key'=>'lampu',
            'value'=>0,
        ]);
        Web::create([
            'key'=>'siram',
            'value'=>0,
        ]);
    }
}
