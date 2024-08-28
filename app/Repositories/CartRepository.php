<?php

namespace App\Repositories;

use App\Models\cartModel;
use App\Repositories\Interfaces\CartRepositoryInterface;
use App\Repositories\BaseRepository;

/**
 * Class cartModelService
 * @package App\Services
 */
class CartRepository extends BaseRepository implements CartRepositoryInterface
{
    protected $model;
    public function __construct(cartModel $model)
    {
        $this->model = $model;
    }
    public function getAllPaginate()
    {
        return $carts = $this->model::all();
    }

    public function findCart(array $column = ['*'], int $id_user = 0, $perpage = 20)
    {
        $query = $this->model
        ->select($column)
        ->where('id_user', '=', $id_user)
        ->paginate($perpage);

        if (!empty($join)) {
            $query->join(...$join);
        }

        return $query;
    }
}
