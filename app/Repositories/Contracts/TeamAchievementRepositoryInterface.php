<?php

namespace App\Repositories\Contracts;

interface TeamAchievementRepositoryInterface extends RepositoryInterface
{
    public function achievements($number);

    public function search($keyword);
}
