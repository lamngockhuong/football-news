<?php

namespace App\Repositories\Contracts;

interface MatchEventRepositoryInterface extends RepositoryInterface
{
    public function events();

    public function eventsByMatch($matchId);
    
    public function eventsByUser($userId);

    public function search($keyword);
}
