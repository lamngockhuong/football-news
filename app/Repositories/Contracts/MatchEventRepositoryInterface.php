<?php

namespace App\Repositories\Contracts;

interface MatchEventRepositoryInterface extends RepositoryInterface
{
    public function events();

    public function eventsOnlyTrash();

    public function eventsByMatch($matchId);
    
    public function eventsByMatchOnlyTrash($matchId);
    
    public function eventsByUser($userId);

    public function eventsByUserOnlyTrash($userId);

    public function search($keyword);

    public function searchOnlyTrash($keyword);
}
