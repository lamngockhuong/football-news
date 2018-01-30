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

    public function search($keyword)
    {
        return $this->where('name', 'like', "%$keyword%")
            ->orWhere('description', 'like', "%$keyword%")
            ->orWhereHas('country', function ($query) use ($keyword) {
                $query->where('name', 'like', "%$keyword%");
            })->paginate(config('repository.limit'));
    }
}
