<?php

namespace App\Repositories\Eloquent;

use App\Models\Player;
use App\Repositories\Contracts\PlayerRepositoryInterface;

class PlayerRepository extends BaseRepository implements PlayerRepositoryInterface
{
    public function getModel()
    {
        return Player::class;
    }

    public function players(...$args)
    {
        $count = count($args);
        switch ($count) {
            case 1:
                // retrieve players by team id
                $teamId = $args[0];
                return $this->with(['position', 'country'])->findByField('team_id', $teamId)->get();
            case 2:
                // retrieve all players or by pagination
                $number = $args[0];
                $orders = $args[1];
                $repository = $this->with(['country', 'team', 'position']);
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
    }

    public function search($keyword)
    {
        return $this->with(['country', 'team', 'position'])
            ->where('name', 'like', "%$keyword%")
            ->orWhere('description', 'like', "%$keyword%")
            ->orWhere('birthday', 'like', "%$keyword%")
            ->orWhereHas(
                'country',
                function ($query) use ($keyword) {
                    $query->where('name', 'like', "%$keyword%");
                }
            )->orWhereHas(
                'team',
                function ($query) use ($keyword) {
                    $query->where('name', 'like', "%$keyword%");
                }
            )->orWhereHas(
                'position',
                function ($query) use ($keyword) {
                    $query->where('name', 'like', "%$keyword%");
                }
            )->paginate(config('repository.pagination.limit'));
    }
}
