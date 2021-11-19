<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CardtypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cardtypes')->insert($this->dataSeed());
    }

    private function dataSeed()
    {
        $data = [];
        $cardtypes = ['viettel', 'vinaphone', 'mobifone'];
        $values = [10000, 20000, 30000, 50000, 100000, 200000, 300000, 500000, 1000000];
        foreach ($cardtypes as $cardtype){
        foreach ($values as $value) {
                $data[] = [
                    'code' => $cardtype,
                    'value' => $value,
                    'rate' => 20
                ];
            }
        }
        return $data;
    }
}
