<?php

namespace App\Interfaces;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

interface UserInterface
{
    public function storeData(Request $request, array $data);

    public function updateData(Request $request, array $data, Model $model);

    public function deleteData(Model $model);

    public function restoreData(int $id);

    public function forceDeleteData(int $id);
}
