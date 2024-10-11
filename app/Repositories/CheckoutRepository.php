<?php

namespace App\Repositories;

use App\Models\BillModel;
use App\Repositories\Interfaces\CheckoutRepositoryInterface;
use App\Repositories\BaseRepository;

/**
 * Class CheckoutService
 * @package App\Services
 */
class CheckoutRepository extends BaseRepository implements CheckoutRepositoryInterface
{
    protected $model;
    public function __construct(BillModel $model)
    {
        $this->model = $model;
    }
    public function getAllPaginate()
    {
        return $Checkouts = $this->model::all();
    }

    public function pagination(array $column = ['*'], array $condition = [], array $join = [], array $extend = [], $perpage = 20, array $releation = [] )
    {
        $query = $this->model->select($column)->where(function ($query) use ($condition) {
            if (isset ($condition['keyword']) && !empty ($condition['keyword'])) {
                $query->where('name', 'like', '%' . $condition['keyword'] . '%')
                ->orwhere('email', 'like', '%' . $condition['keyword'] . '%')
                ->orwhere('address', 'like', '%' . $condition['keyword'] . '%')
                ->orwhere('phone', 'like', '%' . $condition['keyword'] . '%');
            }

            if(isset($condition['publish']) && $condition['publish'] != 0 && !empty($condition['publish'])  ) {
                $query->where('publish', $condition['publish']);
            }
            return $query;
        });

        if (!empty($join)) {
            $query->join(...$join);
        }

        // thay đổi đường dẫn phân trang tại trang Checkout/index
        return $query->paginate($perpage)->withQueryString()->withPath(env('APP_URL').$extend['path']);
    }

}
