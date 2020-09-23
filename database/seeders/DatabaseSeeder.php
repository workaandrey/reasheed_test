<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Country;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(100)->create();
        Country::factory(10)->create();
        Company::factory(10)->create()->each(function(Company $company) {
            $company->users()->sync(User::take(rand(1, 10))->pluck('id'));
        });
    }
}
