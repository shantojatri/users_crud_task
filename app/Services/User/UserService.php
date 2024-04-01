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

    public function allData()
    {
        return $this->model::all();
    }

    public function getList(int $id)
    {
        return $this->model::where('id', $id)->get();
    }

    public function storeOrUpdateData($request, $data, $ownModel=null)
    {
        $id = $ownModel ? $ownModel->id : null;
        // TODO: while update user password will changed, need to fix this
        $data['password'] = Hash::make($data['password']);
        try {
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
            unlink(storage_path('/app/public/'.User::FILE_UPLOAD_PATH.'/'). $user->avatar);
            // TODO: check with this traits again
            // $this->deleteImage(User::FILE_UPLOAD_PATH, $user, $user->avatar);
            return $user->forceDelete();
        } catch (\Exception $e) {
            $this->logFlashThrow($e);
        }
    }

}
