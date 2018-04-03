<?php

namespace App\Repositories\Eloquent;

use App\Models\PlayerAward;
use App\Repositories\Contracts\PlayerAwardRepositoryInterface;

class PlayerAwardRepository extends BaseRepository implements PlayerAwardRepositoryInterface
{
    public function getModel()
    {
        return PlayerAward::class;
    }

    public function awards($number)
    {
        return $this->with(['player', 'match'])
            ->orderBy('id', 'desc')
            ->paginate($number);
    }

    public function search($keyword)
    {
        return $this->with(['player', 'match'])
            ->where('name', 'like', "%$keyword%")
            ->orWhereHas(
                'player',
                function ($query) use ($keyword) {
                    $query->where('name', 'like', "%$keyword%");
                }
            )->orWhereHas(
                'match',
                function ($query) use ($keyword) {
                    $query->where('name', 'like', "%$keyword%");
                }
            )->paginate(config('repository.pagination.limit'));
    }
}
