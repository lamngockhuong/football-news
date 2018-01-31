<?php

namespace App\Repositories\Contracts;

interface LeagueRepositoryInterface extends RepositoryInterface
{
    public function leagues($numberPerPage);

    public function search($keyword);
}
