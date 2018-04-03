<?php

namespace App\Repositories\Contracts;

interface PlayerRepositoryInterface extends RepositoryInterface
{
    public function players(...$args);
}
