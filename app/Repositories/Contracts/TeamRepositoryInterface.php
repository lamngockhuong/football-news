<?php

namespace App\Repositories\Contracts;

interface TeamRepositoryInterface extends RepositoryInterface
{
    public function search($keyword);
}
