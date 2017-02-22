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
        'App\Organisation' => 'App\Policies\OrganisationPolicy',
        'App\Estate' => 'App\Policies\EstatePolicy',
        'App\Section' => 'App\Policies\SectionPolicy',
        'App\Unit' => 'App\Policies\UnitPolicy',
        'App\Pet' => 'App\Policies\PetPolicy',
        'App\Vehicle' => 'App\Policies\VehiclePolicy',
        'App\Application' => 'App\Policies\ApplicationPolicy',
        'App\Fee' => 'App\Policies\FeePolicy',
        'App\Payment' => 'App\Policies\PaymentPolicy',
        'App\Charge' => 'App\Policies\ChargePolicy',
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
