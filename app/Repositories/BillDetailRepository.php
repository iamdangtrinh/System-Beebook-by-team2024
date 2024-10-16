<?php

namespace App\Repositories;

use App\Models\BillDetailModel;
use App\Repositories\Interfaces\BillDetailRepositoryInterface;
use App\Repositories\BaseRepository;

/**
 * Class BillDetailService
 * @package App\Services
 */
class BillDetailRepository extends BaseRepository implements BillDetailRepositoryInterface
{
    protected $model;
    public function __construct(BillDetailModel $model)
    {
        $this->model = $model;
    }
    public function getAllPaginate()
    {
        return $BillDetails = $this->model::all();
    }

}
