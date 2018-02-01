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

    public function countries($number, array $orders)
    {
        $repository = $this;
        foreach ($orders as $order) {
            $repository = $repository->orderBy($order[0], $order[1]);
        }
        
        switch ($number) {
            case config('repository.pagination.all'):
                return $repository->all();
            case config('repository.pagination.limit'):
                return $repository->paginate($number);
        }
    }

    public function search($keyword, $numberPerPage)
    {
        return $this->where('name', 'like', "%$keyword%")
            ->paginate($numberPerPage);
    }
}
