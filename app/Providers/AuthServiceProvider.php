<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\CourseModel;
use App\Models\MachineModel;
use App\Models\Users;
use App\Models\UserMachineModel;
use App\Policies\ViewAcessPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        MachineModel::class => MachinePolicy::class,
        CourseModel::class => CoursePolicy::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();
    }
}
