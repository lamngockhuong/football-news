<?php

namespace App\Repositories\Eloquent;

use App\Models\TeamAchievement;
use App\Repositories\Contracts\TeamAchievementRepositoryInterface;

class TeamAchievementRepository extends BaseRepository implements TeamAchievementRepositoryInterface
{
    public function getModel()
    {
        return TeamAchievement::class;
    }

    public function achievements($number)
    {
        return $this->with(['team', 'match'])
            ->orderBy('id', 'desc')
            ->paginate($number);
    }

    public function search($keyword)
    {
        return $this->with(['team', 'match'])
            ->where('name', 'like', "%$keyword%")
            ->orWhereHas(
                'team',
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
