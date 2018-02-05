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

    public function matches(...$args)
    {
        $repository = $this;
        $count = count($args);
        switch ($count) {
            case 2:
                // retrieve all matches or by pagination
                $number = $args[0];
                $orders = $args[1];
                break;
            case 3:
                // retrieve all matches or by pagination
                $number = $args[0];
                $orders = $args[1];
                $with = $args[2];
                $repository = $repository->with($with);
                break;
        }

        foreach ($orders as $order) {
            $repository = $repository->orderBy($order[0], $order[1]);
        }

        switch ($number) {
            case config('repository.pagination.all'):
                return $repository->all();
            case config('repository.pagination.limit'):
                return $repository->paginate($number);
        }
    }

    public function matchesForTable($number)
    {
        return $this->matches($number, [['id', 'desc']], ['firstTeam', 'secondTeam', 'league']);
    }

    public function search($keyword)
    {
        return $this->with(['firstTeam', 'secondTeam', 'league'])
            ->where('name', 'like', "%$keyword%")
            ->orWhere('description', 'like', "%$keyword%")
            ->orWhere('start_time', 'like', "%$keyword%")
            ->orWhere('end_time', 'like', "%$keyword%")
            ->orWhere('team1_goal', '=', "$keyword")
            ->orWhere('team2_goal', '=', "$keyword")
            ->orWhereHas(
                'firstTeam',
                function ($query) use ($keyword) {
                    $query->where('name', 'like', "%$keyword%");
                }
            )->orWhereHas(
                'secondTeam',
                function ($query) use ($keyword) {
                    $query->where('name', 'like', "%$keyword%");
                }
            )->orWhereHas(
                'league',
                function ($query) use ($keyword) {
                    $query->where('name', 'like', "%$keyword%");
                }
            )->paginate(config('repository.pagination.limit'));
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

    public function checkTeamHasRank($teamId, $leagueId)
    {
        return $this->where('league_id', '=', $leagueId)
            ->where(
                function ($query) use ($teamId) {
                    $query->where('team1_id', '=', $teamId)
                        ->orWhere('team2_id', '=', $teamId);
                }
            )->get();
    }

    public function matchExists($team1Id, $team2Id, $leagueId)
    {
        $match = $this->findByField('league_id', $leagueId)
            ->where(
                function ($query) use ($team1Id, $team2Id) {
                    $query->where(
                        function ($query) use ($team1Id, $team2Id) {
                            $query->where('team1_id', '=', $team1Id)
                                ->where('team2_id', '=', $team2Id);
                        }
                    )->orWhere(
                        function ($query) use ($team1Id, $team2Id) {
                            $query->where('team1_id', '=', $team2Id)
                                ->where('team2_id', '=', $team1Id);
                        }
                    );
                }
            )
            ->get();

        if (count($match)) {
            return true;
        }

        return false;
    }

    public function matchesForForm()
    {
        return $this->orderBy('name', 'asc')->all();
    }
}
