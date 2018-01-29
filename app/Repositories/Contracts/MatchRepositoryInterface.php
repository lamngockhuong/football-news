<?php

namespace App\Repositories\Contracts;

interface MatchRepositoryInterface extends RepositoryInterface
{
    public function nextMatches($number);
}
