<?php

namespace App\Interfaces;

interface UserInterface
{
    public function allData();

    public function getList(int $id);

    public function storeOrUpdateData($request, array $data, $model);

    public function deleteData($model);

    public function restoreData(int $id);

    public function forceDeleteData(int $id);
}
