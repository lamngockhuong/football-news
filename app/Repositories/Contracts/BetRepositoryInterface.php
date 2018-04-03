<?php

namespace App\Repositories\Contracts;

interface BetRepositoryInterface extends RepositoryInterface
{
    public function bets($number, $orders);

    public function betsByUser($number, $orders, $userId);

    public function search($keyword, $userId);

    public function searchByUser($keyword, $userId);
}
