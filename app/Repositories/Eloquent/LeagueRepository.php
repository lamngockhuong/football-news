<?php

namespace App\Repositories\Eloquent;

use App\Models\League;
use App\Repositories\Contracts\LeagueRepositoryInterface;

class LeagueRepository extends BaseRepository implements LeagueRepositoryInterface
{
    public function getModel()
    {
        return League::class;
    }
}
