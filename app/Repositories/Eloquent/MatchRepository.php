<?php

namespace App\Repositories\Eloquent;

use App\Models\Match;
use App\Repositories\Contracts\MatchRepositoryInterface;
use Carbon\Carbon;

class MatchRepository extends BaseRepository implements MatchRepositoryInterface
{
    public function getModel()
    {
        return Match::class;
    }

    public function nextMatches($number)
    {
        return $this->with(['firstTeam', 'secondTeam'])
            ->orderBy('start_time', 'DESC')
            ->findWhere([['start_time', '>', Carbon::today()->toDateString()]])
            ->take($number)->get();
    }

    public function nextMatchesPagination($number)
    {
        return $this->with(['firstTeam', 'secondTeam'])
            ->orderBy('start_time', 'DESC')
            ->findWhere([['start_time', '>', Carbon::today()->toDateString()]])
            ->paginate($number);
    }
}
