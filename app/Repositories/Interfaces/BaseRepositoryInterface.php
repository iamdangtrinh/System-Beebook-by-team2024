<?php
// app/Repositories/Interfaces/BaseRepositoryInterface.php

namespace App\Repositories\Interfaces;

interface BaseRepositoryInterface
{
    public function getById($id);
    public function getAll();
    public function create(array $attributes);
    public function update($id, array $attributes);
    public function delete($id);
}
