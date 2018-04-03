<?php

namespace App\Repositories\Contracts;

interface LeagueRepositoryInterface extends RepositoryInterface
{
    public function leagues(...$args);

    public function search($keyword);
}
