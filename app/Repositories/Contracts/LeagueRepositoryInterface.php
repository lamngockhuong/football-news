<?php

namespace App\Repositories\Contracts;

interface LeagueRepositoryInterface extends RepositoryInterface
{
    public function search($keyword);
}
