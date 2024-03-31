<?php

namespace App\Services\User;

use App\Models\User;
use App\Services\BaseService;
use App\Traits\ImageUploadOrDeleteTraits\ImageUploadOrDeleteTraits;

class UserService extends BaseService{

    use ImageUploadOrDeleteTraits;

    protected $model;

    public function __construct()
    {
        $this->model = User::class;
    }

    public function storeOrUpdateWithImage($request, $data, $ownModel=null)
    {
        $id = $ownModel ? $ownModel->id : null;
        try {
            if($id){
                $imageName = $this->uploadImage($request, 'logo', User::FILE_UPLOAD_PATH, $ownModel);
            } else{
                $imageName = $this->uploadImage($request, 'logo', User::FILE_UPLOAD_PATH);
            }
            $data['avatar'] = $imageName;
            return parent::storeOrUpdate($data, $id);
        } catch (\Exception $e) {
            $this->logFlashThrow($e);
        }
    }
}
