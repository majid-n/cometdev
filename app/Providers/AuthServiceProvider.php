<?php

namespace App\Providers;

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
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Comment::class  => CommentPolicy::class,
        Resume::class   => ResumePolicy::class,
        Lang::class     => LangPolicy::class,
        Edu::class      => EduPolicy::class,
        Edu::class      => XpPolicy::class,
        Skill::class    => SkillPolicy::class,
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);

        //
    }
}
