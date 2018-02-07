<?php

namespace App\Repositories\Eloquent;

use App\Models\MatchEvent;
use App\Repositories\Contracts\MatchEventRepositoryInterface;

class MatchEventRepository extends BaseRepository implements MatchEventRepositoryInterface
{
    public function getModel()
    {
        return MatchEvent::class;
    }

    public function events()
    {
        return $this->with(['match', 'user'])
            ->orderBy('id', 'desc')
            ->paginate(config('repository.pagination.limit'));
    }

    public function eventsByMatch($matchId)
    {
        return $this->with(['match', 'user'])
            ->where('match_id', '=', $matchId)
            ->orderBy('id', 'desc')
            ->paginate(config('repository.pagination.limit'));
    }

    public function eventsByUser($userId)
    {
        return $this->with(['match', 'user'])
            ->where('user_id', '=', $userId)
            ->orderBy('id', 'desc')
            ->paginate(config('repository.pagination.limit'));
    }

    public function search($keyword)
    {
        return $this->with(['match', 'user'])
            ->where('title', 'like', "%$keyword%")
            ->where('description', 'like', "%$keyword%")
            ->where('content', 'like', "%$keyword%")
            ->orWhereHas(
                'match',
                function ($query) use ($keyword) {
                    $query->where('name', 'like', "%$keyword%");
                }
            )->orWhereHas(
                'user',
                function ($query) use ($keyword) {
                    $query->where('name', 'like', "%$keyword%");
                }
            )->paginate(config('repository.pagination.limit'));
    }
}
