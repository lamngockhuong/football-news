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

    public function search($keyword)
    {
        return $this->where('name', 'like', "%$keyword%")
            ->orWhere('description', 'like', "%$keyword%")
            ->paginate(config('repository.limit'));
    }
}
