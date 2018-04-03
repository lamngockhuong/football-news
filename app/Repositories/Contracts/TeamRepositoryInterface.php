<?php

namespace App\Repositories\Contracts;

interface TeamRepositoryInterface extends RepositoryInterface
{
    public function teams($number, $orders);

    public function teamsWithCountry($number, $orders);

    public function search($keyword);
}
