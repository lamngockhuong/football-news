<?php

namespace App\Repositories\Eloquent;

use App\Models\Category;
use App\Repositories\Contracts\CategoryRepositoryInterface;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    public function getModel()
    {
        return Category::class;
    }

    public function categoriesForForm()
    {
        return $this->orderBy('name', 'asc')->all();
    }

    public function categories($number)
    {
        $repository = $this->orderBy('id', 'desc');

        switch ($number) {
            case config('repository.pagination.all'):
                return $repository->all();
            case config('repository.pagination.limit'):
                return $repository->paginate($number);
        }
    }

    public function search($keyword)
    {
        return $this->where('name', 'like', "%$keyword%")
            ->orWhere('description', 'like', "%$keyword%")
            ->paginate(config('repository.pagination.limit'));
    }
}
