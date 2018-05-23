<?php

namespace App\Providers;

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
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('attendance-crud', function ($user) {

            if($user->role_id >= 2) 
            {
                return true;
            }

            return false;
        });

        Gate::define('blood-group-crud', function ($user) {

            if($user->role_id >= 5)
            {
                return true;
            }

            return false;
        });

        Gate::define('class-assign-crud', function ($user) {

            if($user->role_id >= 3)
            {
                return true;
            }

            return false;
        });

        /**
         * Only View Own Classes
         */
        Gate::define('class-assign-view-single', function ($user, $classAssign) {

            if($user->role_id >= 2 && $classAssign->teacher->user->id == $user->id)
            {
                return true;
            }

            return false;
        });

        Gate::define('exam-term-crud', function ($user) {

            if($user->role_id >= 5)
            {
                return true;
            }

            return false;
        });

        Gate::define('gender-crud', function ($user) {

            if($user->role_id >= 5)
            {
                return true;
            }

            return false;
        });

        Gate::define('grade-crud', function ($user) {

            if($user->role_id >= 5)
            {
                return true;
            }

            return false;
        });

        Gate::define('group-crud', function ($user) {

            if($user->role_id >= 5)
            {
                return true;
            }

            return false;
        });

        Gate::define('system-log-crud', function ($user) {

            if($user->role_id >= 5)
            {
                return true;
            }

            return false;
        });

        Gate::define('mark-crud', function ($user) {

            if($user->role_id >= 2)
            {
                return true;
            }

            return false;
        });

        Gate::define('merit-list-crud', function ($user) {

            if($user->role_id >= 2)
            {
                return true;
            }

            return false;
        });

        Gate::define('notice-crud', function ($user) {

            if($user->role_id >= 3)
            {
                return true;
            }

            return false;
        });

        Gate::define('optional-assign-crud', function ($user) {

            if($user->role_id >= 3)
            {
                return true;
            }

            return false;
        });

        Gate::define('preference-crud', function ($user) {

            if($user->role_id >= 4) 
            {
                return true;
            }

            return false;
        });

        Gate::define('promotion-crud', function ($user) {

            if($user->role_id >= 3)
            {
                return true;
            }

            return false;
        });

        Gate::define('religion-crud', function ($user) {

            if($user->role_id >= 5)
            {
                return true;
            }

            return false;
        });

        Gate::define('role-crud', function ($user) {

            if($user->role_id >= 5)
            {
                return true;
            }

            return false;
        });

        Gate::define('section-crud', function ($user) {

            if($user->role_id >= 5)
            {
                return true;
            }

            return false;
        });

        Gate::define('sms-send', function ($user) {

            if($user->role_id >= 3)
            {
                return true;
            }

            return false;
        });

        Gate::define('sms-history', function ($user) {

            if($user->role_id >= 3)
            {
                return true;
            }

            return false;
        });

        Gate::define('shift-crud', function ($user) {

            if($user->role_id >= 5)
            {
                return true;
            }

            return false;
        });

        Gate::define('staff-crud', function ($user) {

            if($user->role_id >= 4) 
            {
                return true;
            }

            return false;
        });

        Gate::define('student-crud', function ($user) {

            if($user->role_id >= 3)
            {
                return true;
            }

            return false;
        });

        Gate::define('subject-crud', function ($user) {

            if($user->role_id >= 5)
            {
                return true;
            }

            return false;
        });

        Gate::define('teacher-crud', function ($user) {

            if($user->role_id >= 3)
            {
                return true;
            }

            return false;
        });

        Gate::define('the-class-crud', function ($user) {

            if($user->role_id >= 5)
            {
                return true;
            }

            return false;
        });



    }
}
