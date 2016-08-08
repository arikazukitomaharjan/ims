<?php

namespace App\Repository;

/**
 * Created by PhpStorm.
 * User: sabin
 * Date: 6/8/16
 * Time: 12:40 PM
 */

use Bosnadev\Repositories\Contracts\RepositoryInterface;
use Bosnadev\Repositories\Eloquent\Repository;

class CategoryRepository extends Repository
{

    public function model()
    {

        // TODO: Implement model() method.
        return 'App\Category';
    }

    public function show()
    {

        return $this->makeModel()->latest()->get();
    }

    public function add($data)
    {

        return $this->makeModel()->create($data);
    }

    public function edit($id, $data)
    {

        return $this->makeModel()->find($id)->update($data);
    }

    public function remove($id)
    {

        return $this->makeModel()->find($id)->delete();
    }
    public function totalCategoryCount(){
        return $this->makeModel()
            ->count();
    }
}