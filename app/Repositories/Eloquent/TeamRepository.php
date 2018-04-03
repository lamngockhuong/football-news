<?php

namespace App\Repositories\Eloquent;

use App\Models\Team;
use App\Repositories\Contracts\TeamRepositoryInterface;

class TeamRepository extends BaseRepository implements TeamRepositoryInterface
{
    public function getModel()
    {
        return Team::class;
    }

    public function teams($number, $orders)
    {
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

    public function teamsWithCountry($number, $orders)
    {
        $repository = $this->with('country');
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

    public function search($keyword)
    {
        return $this->with('country')
            ->where('name', 'like', "%$keyword%")
            ->orWhere('description', 'like', "%$keyword%")
            ->orWhereHas(
                'country',
                function ($query) use ($keyword) {
                    $query->where('name', 'like', "%$keyword%");
                }
            )->paginate(config('repository.pagination.limit'));
    }
}
