<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data=[
            'Труба круглая',
            'Труба профильная',
            'Круг',
            'Арматура',
            'Полоса',
            'Уголок',
            'Лист',
            'Шестигранник',
            'Швеллер',
            'Двутавр',
            'Квадрат'
            ];
        foreach ($data as $category)
        DB::table('categories')->insert([
            'name'=>$category,
            'created_at' => Carbon::now()->toDateTimeString()
        ]);
    }
}
