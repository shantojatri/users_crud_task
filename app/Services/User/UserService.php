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
        // try {
        //     $this->deleteImage(User::FILE_UPLOAD_PATH, $ownModel, 'avatar');
        // } catch (\Exception $e) {
        // }
        return parent::delete($ownModel);
    }

}
