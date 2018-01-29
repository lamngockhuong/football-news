<?php

namespace App\Repositories\Eloquent;

use App\Models\Rank;
use App\Repositories\Contracts\RankRepositoryInterface;
use Carbon\Carbon;

class RankRepository extends BaseRepository implements RankRepositoryInterface
{
    public function getModel()
    {
        return Rank::class;
    }

    public function ranking($leagueId)
    {
        return $this->findByField('league_id', $leagueId)
            ->with('team')
            ->orderBy('score', 'DESC')
            ->get();
    }
}
