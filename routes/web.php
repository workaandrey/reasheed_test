<?php

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $countryName = \App\Models\Country::all()->random()->name;
    $users = User::query()
        ->with('companies')
        ->whereHas('companies', function (Builder $builder) use ($countryName) {
            return $builder->whereHas('country', function (Builder $builder) use ($countryName) {
                return $builder->where('name', $countryName);
            });
        })
        ->get();

    return [
        'countryName' => $countryName,
        'users' => $users->map(function (User $user) {
            return [
                'id' => $user->id,
                'name' => $user->name,
                'companies' => $user->companies->map(function(Company $company) {
                    return [
                        'name' => $company->name,
                        'attached_at' => $company->pivot->attached_at
                    ];
                })
            ];
        })
    ];
});
