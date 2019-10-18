<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('statuses')->insert([[
            'id' => 1,
            'nome' => "Ativo",
            'descricao' => "Ativo"
        ],[
            'id' => 2,
            'nome' => "Cancelado",
            'descricao' => "Cancelado"
        ]]);
    }
}
