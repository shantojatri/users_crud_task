<?php

namespace App\Interfaces;

interface UserInterface
{
    public function allData();

    public function getList(int $id);

    public function storeOrUpdateData($request, array $data, $model);

    public function deleteData($model);
}
