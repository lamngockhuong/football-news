<?php

namespace App\Repositories\Eloquent;

use App\Models\Country;
use App\Repositories\Contracts\CountryRepositoryInterface;

class CountryRepository extends BaseRepository implements CountryRepositoryInterface
{
    public function getModel()
    {
        return Country::class;
    }

    public function countries($numberPerPage)
    {
        return $this->orderBy('id', 'desc')
            ->paginate($numberPerPage);
    }

    public function search($keyword, $numberPerPage)
    {
        return $this->where('name', 'like', "%$keyword%")
            ->paginate($numberPerPage);
    }
}
