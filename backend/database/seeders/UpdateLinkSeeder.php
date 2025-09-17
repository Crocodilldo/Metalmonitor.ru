<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class UpdateLinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
     $data = [
            [              //FormulaM2
                'shop_id' => '1',
                'category_id' => '4',
                'url' => 'https://formulam2.ru/catalog/21_obshchestroitelnye_materialy/metalloprokat/armatura_metallicheskaya/'
            ],

            [
                'shop_id' => '1',
                'category_id' => '5',
                'url' => 'https://formulam2.ru/catalog/21_obshchestroitelnye_materialy/metalloprokat/metallicheskie_polosy/'
            ],

            [
                'shop_id' => '1',
                'category_id' => '2',
                'url' => 'https://formulam2.ru/catalog/21_obshchestroitelnye_materialy/metalloprokat/truby_metallicheskie/'
            ],

            [
                'shop_id' => '1',
                'category_id' => '6',
                'url' => 'https://formulam2.ru/catalog/21_obshchestroitelnye_materialy/metalloprokat/ugolki/'
            ],

            //Arsenal

            [
                'shop_id' => '2',
                'category_id' => '2',
                'url' => 'https://sdl-arsenal.ru/catalog/metalloprokat/truba/truba_profilnaya/?viewType=list&paging=48'
            ],

            [
                'shop_id' => '2',
                'category_id' => '1',
                'url' => 'https://sdl-arsenal.ru/catalog/metalloprokat/truba/truby_el_sv/?viewType=list&paging=96'
            ],

            [
                'shop_id' => '2',
                'category_id' => '6',
                'url' => 'https://sdl-arsenal.ru/catalog/metalloprokat/ugolok_1/?viewType=list'
            ],

            [
                'shop_id' => '2',
                'category_id' => '9',
                'url' => 'https://sdl-arsenal.ru/catalog/metalloprokat/shveller_balka/shveller/?viewType=list'
            ],

            [
                'shop_id' => '2',
                'category_id' => '10',
                'url' => 'https://sdl-arsenal.ru/catalog/metalloprokat/shveller_balka/balka/?viewType=list'
            ],

            [
                'shop_id' => '2',
                'category_id' => '4',
                'url' => 'https://sdl-arsenal.ru/catalog/metalloprokat/armatura_krug_provoloka_vyazalnaya/armatura_metallicheskaya/?viewType=list'
            ],

            [
                'shop_id' => '2',
                'category_id' => '7',
                'url' => 'https://sdl-arsenal.ru/catalog/metalloprokat/listovoy_metall/list_do_4mm/?viewType=list'
            ],

            [
                'shop_id' => '2',
                'category_id' => '5',
                'url' => 'https://sdl-arsenal.ru/catalog/metalloprokat/listovoy_metall/polosa/?viewType=list'
            ],

            [
                'shop_id' => '2',
                'category_id' => '8',
                'url' => 'https://sdl-arsenal.ru/catalog/metalloprokat/shestigrannik_kvadrat/shestigrannik/?viewType=list'
            ],

            [
                'shop_id' => '2',
                'category_id' => '11',
                'url' => 'https://sdl-arsenal.ru/catalog/metalloprokat/shestigrannik_kvadrat/kvadrat/?viewType=list'
            ],

            //MXT22

            [
                'shop_id' => '3',
                'category_id' => '1',
                'url' => 'http://www.mxt22.ru/catalog/1057/?page_count=3'
            ],

            [
                'shop_id' => '3',
                'category_id' => '2',
                'url' => 'http://www.mxt22.ru/catalog/1058/?page_count=3'
            ],

            [
                'shop_id' => '3',
                'category_id' => '3',
                'url' => 'http://www.mxt22.ru/catalog/998/?page_count=3'
            ],

            [
                'shop_id' => '3',
                'category_id' => '4',
                'url' => 'http://www.mxt22.ru/catalog/999/?page_count=3'
            ],

            [
                'shop_id' => '3',
                'category_id' => '5',
                'url' => 'http://www.mxt22.ru/catalog/1022/?page_count=3'
            ],

            [
                'shop_id' => '3',
                'category_id' => '6',
                'url' => 'http://www.mxt22.ru/catalog/1061/?page_count=3'
            ],

            [
                'shop_id' => '3',
                'category_id' => '7',
                'url' => 'http://www.mxt22.ru/catalog/1055/?page_count=3'
            ],

            [
                'shop_id' => '3',
                'category_id' => '8',
                'url' => 'http://www.mxt22.ru/catalog/1069/?page_count=3'
            ],

            [
                'shop_id' => '3',
                'category_id' => '9',
                'url' => 'http://www.mxt22.ru/catalog/1068/?page_count=3'
            ],

            [
                'shop_id' => '3',
                'category_id' => '10',
                'url' => 'http://www.mxt22.ru/catalog/984/?page_count=3'
            ],

            [
                'shop_id' => '3',
                'category_id' => '11',
                'url' => 'http://www.mxt22.ru/catalog/996/?page_count=3'
            ],



        ];


        foreach ($data as $link)

            DB::table('update_links')->insert([
                'shop_id' => $link['shop_id'],
                'category_id' => $link['category_id'],
                'url' => $link['url'],
                'created_at' => Carbon::now()->toDateTimeString()
            ]);
    }
}
