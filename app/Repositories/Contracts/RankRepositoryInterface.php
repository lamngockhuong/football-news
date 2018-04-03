<?php

namespace App\Repositories\Contracts;

interface RankRepositoryInterface extends RepositoryInterface
{
    public function ranking($leagueId);
}
