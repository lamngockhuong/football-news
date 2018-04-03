<?php

namespace App\Repositories\Eloquent;

use App\Models\Bet;
use App\Repositories\Contracts\BetRepositoryInterface;

class BetRepository extends BaseRepository implements BetRepositoryInterface
{
    public function getModel()
    {
        return Bet::class;
    }

    public function bets($number, $orders)
    {
        $repository = $this->with(
            [
                'user',
                'match' => function ($query) {
                    $query->with('firstTeam')->with('secondTeam');
                }
            ]
        );
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

    public function betsByUser($number, $orders, $userId)
    {
        $repository = $this->with(
            [
                'match' => function ($query) {
                    $query->with('firstTeam')->with('secondTeam');
                }
            ]
        )->where('user_id', '=', $userId);

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

    public function search($keyword, $userId)
    {
        return $this->with(
            [
                'user',
                'match' => function ($query) {
                    $query->with('firstTeam')->with('secondTeam');
                }
            ]
        )->where('user_id', '=', $userId)
        ->where('coin', '=', $keyword)
        ->where('team1_goal', '=', $keyword)
        ->orWhere('team2_goal', '=', $keyword)
        ->orWhereHas(
            'user',
            function ($query) use ($keyword) {
                $query->where('name', 'like', "%$keyword%");
            }
        )
        ->orWhereHas(
            'match',
            function ($query) use ($keyword) {
                $query->where('name', 'like', "%$keyword%")
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
                    );
            }
        )->paginate(config('repository.pagination.limit'));
    }

    public function searchByUser($keyword, $userId)
    {
        return $this->with(
            [
                'match' => function ($query) {
                    $query->with('firstTeam')->with('secondTeam');
                }
            ]
        )->where('user_id', '=', $userId)
        ->where('coin', '=', $keyword)
        ->where('team1_goal', '=', $keyword)
        ->orWhere('team2_goal', '=', $keyword)
        ->orWhereHas(
            'match',
            function ($query) use ($keyword) {
                $query->where('name', 'like', "%$keyword%")
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
                    );
            }
        )->paginate(config('repository.pagination.limit'));
    }
}
