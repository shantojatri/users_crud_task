<?php

namespace App\Services\User;

use App\Models\User;
use App\Services\BaseService;
use App\Interfaces\UserInterface;
use Illuminate\Support\Facades\Hash;

class UserService extends BaseService implements UserInterface
{

    protected $model;

    public function __construct()
    {
        $this->model = User::class;
    }

    public function storeOrUpdateData($request, $data, $ownModel=null)
    {
        $id = $ownModel ? $ownModel->id : null;
        try {
            if($data['password']){
                $data['password'] = Hash::make($data['password']);
            } else{
                $data['password'] = $ownModel->password;
            }

            if($id){
                $imageName = $this->uploadImage($request, 'avatar', User::FILE_UPLOAD_PATH, $ownModel);
            } else{
                $imageName = $this->uploadImage($request, 'avatar', User::FILE_UPLOAD_PATH);
            }
            $data['avatar'] = $imageName;
            return parent::storeOrUpdate($data, $id);
        } catch (\Exception $e) {
            $this->logFlashThrow($e);
        }
    }

    public function deleteData($ownModel)
    {
        try {
            return parent::delete($ownModel);
        } catch (\Exception $e) {
            $this->logFlashThrow($e);
        }
    }

    public function restoreData($id)
    {
        try {
            return $this->model::withTrashed()->find($id)->restore();
        } catch (\Exception $e) {
            $this->logFlashThrow($e);
        }
    }

    public function forceDeleteData($id)
    {
        try {
            $user = User::where('id', $id)->withTrashed()->first();
            deleteImage($user->avatar, User::FILE_UPLOAD_PATH);
            return $user->forceDelete();
        } catch (\Exception $e) {
            $this->logFlashThrow($e);
        }
    }
}
