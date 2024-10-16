<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\CouponRepositoryInterface;
use App\Repositories\BaseRepository;

/**
 * Class UserService
 * @package App\Services
 */
class UserRepository extends BaseRepository implements CouponRepositoryInterface
{
    protected $model;
    public function __construct(User $model)
    {
        $this->model = $model;
    }
    public function getAllPaginate()
    {
        return $users = $this->model::all();
    }


}
