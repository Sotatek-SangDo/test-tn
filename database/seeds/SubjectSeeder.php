<?php

use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subjects')->truncate();
        $data = [
            [
                'name' => 'Toán',
                'time_test' => '60',
            ],
           [
                'name' => 'Toán1',
                'time_test' => '45',
            ],
            [
                'name' => 'Hóa',
                'time_test' => '60',
            ],
            [
                'name' => 'Lý',
                'time_test' => '60',
            ],
            [
                'name' => 'Anh',
                'time_test' => '60',
            ],
        ];

        DB::table('subjects')->insert($data);
    }
}
