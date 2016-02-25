<?php

namespace App\Providers;

use Sentinel;
use Illuminate\Auth\Access\Gate;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Policies\CommentPolicy;
use App\Policies\ResumePolicy;
use App\Policies\LangPolicy;
use App\Policies\EduPolicy;
use App\Policies\XpPolicy;
use App\Policies\SkillPolicy;
use App\Comment;
use App\Resume;
use App\Lang;
use App\Edu;
use App\Xp;
use App\Skill;

class AuthServiceProvider extends ServiceProvider
{

    # Indicates if loading of the provider is deferred.
    # use Register and bind when needed. 
    # prevent run register on every request.
    protected $defer = true;

    # The policy mappings for the application.
    protected $policies = [
        Comment::class  => CommentPolicy::class,
        Resume::class   => ResumePolicy::class,
        Lang::class     => LangPolicy::class,
        Edu::class      => EduPolicy::class,
        Xp::class       => XpPolicy::class,
        Skill::class    => SkillPolicy::class,
    ];

    # Register any application authentication / authorization services.
    public function boot(GateContract $gate) {
        $this->registerPolicies($gate);
    }

    # Register bindings in the service container.
    public function register() {
        $this->registerAccessGate();
    }

    # Register the access gate service with Sentinel resolving the user.
    protected function registerAccessGate() {
        $this->app->singleton(GateContract::class, function ($app) {
            return new Gate($app, function () use ($app) { return Sentinel::getUser(); });
        });
    }

    # Get the services provided by the provider.
    public function provides() {
        return [GateContract::class];
    }
}
