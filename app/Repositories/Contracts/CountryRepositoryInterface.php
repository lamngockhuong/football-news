<?php

namespace App\Repositories\Contracts;

interface CountryRepositoryInterface extends RepositoryInterface
{
    public function countries($numberPerPage);

    public function search($keyword, $numberPerPage);
}
