<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function getModel()
    {
        return User::class;
    }

    public function users($number, $orders)
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

    public function usersByStatus($number, $orders, $status)
    {
        $repository = $this->where('is_actived', '=', $status);
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

    public function usersByLevel($number, $orders, $level)
    {
        $repository = $this->where('is_admin', '=', $level);
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
        return $this->where('name', 'like', "%$keyword%")
            ->orWhere('email', 'like', "%$keyword%")
            ->orWhere('coin', '=', $keyword)
            ->paginate(config('repository.pagination.limit'));
    }
}
