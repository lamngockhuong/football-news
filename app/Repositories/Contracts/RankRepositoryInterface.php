<?php

namespace App\Repositories\Contracts;

interface RankRepositoryInterface extends RepositoryInterface
{
    public function ranking($leagueId);

    public function ranks(...$args);

    public function leaguesInRanking();

    public function search($keyword, $leagueId);
}
