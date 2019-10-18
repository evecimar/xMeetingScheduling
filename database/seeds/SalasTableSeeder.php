<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SalasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('salas')->insert([[
            'id' => 1,
            'nome' => "Sala 1",
            'descricao' => "Sala de reunião 1"
        ],[
            'id' => 2,
            'nome' => "Sala 2",
            'descricao' => "Sala de reunião 2"
        ]]);
    }
}
