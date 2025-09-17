<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Actions\CreateSlugAction;

class ShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(CreateSlugAction $slugAction): void
    {
        $data = [
            [
                'name' => 'Формула М2',
                'url' => 'https://formulam2.ru',
            ],

            [
                'name' => 'Арсенал',
                'url' => 'https://sdl-arsenal.ru',
            ],

            [
                'name' => 'Металлхозторг',
                'url' => 'http://www.mxt22.ru/',
            ]
        ];

            foreach ($data as $shop)
                DB::table('shops')->insert([
                    'name' => $shop['name'],
                    'slug' => $slugAction->handle($shop['name']),
                    'url' => $shop['url'],
                    'created_at' => Carbon::now()->toDateTimeString()
                ]);
    }
}
