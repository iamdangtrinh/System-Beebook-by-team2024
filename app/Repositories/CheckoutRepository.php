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

}
