<?php

namespace App\Repositories\Contracts;

interface PositionRepositoryInterface extends RepositoryInterface
{
    public function positions($number, $orders);
}
