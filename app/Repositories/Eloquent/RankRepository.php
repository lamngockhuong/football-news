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

    public function ranks(...$args)
    {
        $repository = $this;
        $count = count($args);
        switch ($count) {
            case 2:
                // retrieve all ranks or by pagination
                $number = $args[0];
                $orders = $args[1];
                break;
            case 3:
                // retrieve all ranks or by pagination
                $number = $args[0];
                $orders = $args[1];
                $with = $args[2];
                $repository = $repository->with($with);
                break;
            case 4:
                // retrieve all ranks or by pagination
                $number = $args[0];
                $orders = $args[1];
                $with = $args[2];
                $where = $args[3];
                $repository = $repository->findWhere($where);
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

    public function leaguesInRanking()
    {
        return $this->with('league')->groupBy('league_id')->get(['league_id']);
    }

    public function search($keyword, $leagueId)
    {
        $repository = $this->with(['team', 'league']);
        if ($leagueId > 0) {
            $repository = $repository->where('league_id', '=', $leagueId);
        }

        return $this->where(
            function ($query) use ($keyword) {
                $query->where('won', 'like', "%$keyword%")
                    ->orWhere('drawn', 'like', "%$keyword%")
                    ->orWhere('lost', 'like', "%$keyword%")
                    ->orWhere('goals_for', 'like', "%$keyword%")
                    ->orWhere('goals_against', 'like', "%$keyword%")
                    ->orWhere('score', 'like', "%$keyword%")
                    ->orWhereHas(
                        'team',
                        function ($query) use ($keyword) {
                            $query->where('name', 'like', "%$keyword%");
                        }
                    )->orWhereHas(
                        'league',
                        function ($query) use ($keyword) {
                            $query->where('name', 'like', "%$keyword%");
                        }
                    );
            }
        )->paginate(config('repository.pagination.limit'));
    }
}
