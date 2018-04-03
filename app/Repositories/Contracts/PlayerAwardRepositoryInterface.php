<?php

namespace App\Repositories\Contracts;

interface PlayerAwardRepositoryInterface extends RepositoryInterface
{
    public function awards($number);

    public function search($keyword);
}
