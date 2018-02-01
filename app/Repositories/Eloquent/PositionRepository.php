<?php

namespace App\Repositories\Eloquent;

use App\Models\Position;
use App\Repositories\Contracts\PositionRepositoryInterface;

class PositionRepository extends BaseRepository implements PositionRepositoryInterface
{
    public function getModel()
    {
        return Position::class;
    }

    public function positions($number, $orders)
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
}
