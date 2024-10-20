<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Article;
use Illuminate\Database\Seeder;
use Laravolt\Indonesia\Seeds\CitiesSeeder;
use Laravolt\Indonesia\Seeds\VillagesSeeder;
use Laravolt\Indonesia\Seeds\DistrictsSeeder;
use Laravolt\Indonesia\Seeds\ProvincesSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            // ESSENTIALS
            CompanySeeder::class,
            ProvincesSeeder::class,
            CitiesSeeder::class,
            DistrictsSeeder::class,
            VillagesSeeder::class,
            PermissionSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            MenuSeeder::class,
            SubMenuSeeder::class,
            
            // MASTER
            CategoryTypeSeeder::class,
            CategorySeeder::class,
            
            // CMS
            TagSeeder::class,
        ]);

        Article::factory()->count(10)->create();
        $this->call(ArticleTagSeeder::class);
    }
}
