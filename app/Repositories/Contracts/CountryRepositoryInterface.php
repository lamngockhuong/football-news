<?php

namespace App\Repositories\Contracts;

interface CountryRepositoryInterface extends RepositoryInterface
{
    public function countries($number, array $orders);

    public function search($keyword, $numberPerPage);
}
