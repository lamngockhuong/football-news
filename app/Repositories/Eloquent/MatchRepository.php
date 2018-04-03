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

    public function nextLeagueMatches($leagueId, $number)
    {
        return $this->findByField('league_id', $leagueId)
            ->with(['firstTeam', 'secondTeam'])
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

    public function nextLeagueMatchesPagination($leagueId, $number)
    {
        return $this->findByField('league_id', $leagueId)
            ->with(['firstTeam', 'secondTeam'])
            ->orderBy('start_time', 'DESC')
            ->findWhere([['start_time', '>', Carbon::today()->toDateString()]])
            ->paginate($number);
    }

    public function results($leagueId, $number)
    {
        return $this->with(['firstTeam', 'secondTeam'])
            ->orderBy('end_time', 'DESC')
            ->findWhere([['end_time', '<=', Carbon::today()->toDateString()]])
            ->paginate($number);
    }
}
