<?php

namespace App\Providers;

use Laravel\Passport\Passport;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Organisation' => 'App\policies\OrganisationPolicy',
        'App\Estate' => 'App\policies\EstatePolicy',
        'App\Section' => 'App\policies\SectionPolicy',
        'App\Unit' => 'App\policies\UnitPolicy',
        'App\Pet' => 'App\policies\PetPolicy',
        'App\Vehicle' => 'App\policies\VehiclePolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::routes();
    }
}
