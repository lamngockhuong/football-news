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

    public function leagues(...$args)
    {
        $count = count($args);
        switch ($count) {
            case 2:
                // retrieve all leagues or by pagination
                $number = $args[0];
                $orders = $args[1];
                $repository = $this;
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
        return $this->where('name', 'like', "%$keyword%")
            ->orWhere('description', 'like', "%$keyword%")
            ->paginate(config('repository.pagination.limit'));
    }
}
