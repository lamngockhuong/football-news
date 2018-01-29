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

    public function players($teamId)
    {
        return $this->with(['position', 'country'])->findByField('team_id', $teamId)->get();
    }
}
