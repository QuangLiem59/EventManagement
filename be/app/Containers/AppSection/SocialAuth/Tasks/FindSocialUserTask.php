<?php

namespace App\Containers\AppSection\SocialAuth\Tasks;

use Apiato\Core\Abstracts\Tasks\Task;

class FindSocialUserTask extends Task
{
    private mixed $repository;

    public function __construct()
    {
        $this->repository = app(config('appSection-socialAuth.user.repository'));
    }

    public function run($socialProvider, $socialId, $email)
    {
        $user = $this->repository->findWhere([
            'social_provider' => $socialProvider,
            'social_id' => $socialId,
        ])->first();

        if ($user) {
            return $user;
        }

        return $this->repository->findByField('email', $email)->first();
    }
}
