<?php
namespace App\Repository;

/**
 * Created by PhpStorm.
 * User: sabin
 * Date: 6/8/16
 * Time: 12:41 PM
 */
use Bosnadev\Repositories\Contracts\RepositoryInterface;
use Bosnadev\Repositories\Eloquent\Repository;

class UserRepository extends Repository
{

    public function model()
    {

        // TODO: Implement model() method.
        return 'App\User';
    }
}