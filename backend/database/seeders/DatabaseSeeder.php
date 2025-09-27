<?php

namespace Database\Seeders;

use Database\Seeders\ShopSeeder;
use Database\Seeders\CategorySeeder;
use Database\Seeders\UpdateLinkSeeder;
use Database\Seeders\PhpQuerySelectorSeeder;
use Database\Seeders\StandardProductParameterSeeder;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(ShopSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(UpdateLinkSeeder::class);
        $this->call(PhpQuerySelectorSeeder::class);
        $this->call(StandardProductParameterSeeder::class);
        $this->call(UserSeeder::class);
    }
}
