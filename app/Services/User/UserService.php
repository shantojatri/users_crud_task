<?php

namespace App\Services\User;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Interfaces\UserInterface;
use App\Services\ImageUploadService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;

class UserService extends ImageUploadService implements UserInterface
{

    /**
     * Const variable
     */
    private const IMAGE_INPUT_NAME = 'avatar';

    /**
     * Construct property promotion
     */
    public function __construct(protected User $model)
    {
    }

    public function storeData(Request $request, array $data)
    {
        try {
            $data['password'] = Hash::make($data['password']);
            $imageName = $this->uploadImage($request, self::IMAGE_INPUT_NAME, User::FILE_UPLOAD_PATH);
            $data['avatar'] = $imageName;

            return $this->model::create($data);
        } catch (Exception $e) {
            $this->logFlashThrow($e);
        }
    }

    public function updateData(Request $request, array $data, Model $model)
    {
        try {
            if($data['password']) $data['password'] = Hash::make($data['password']);

            $data['password'] = $model->password;
            $imageName = $this->uploadImage($request, 'avatar', User::FILE_UPLOAD_PATH, $model);
            $data['avatar'] = $imageName;

            $this->model->update($data);
        } catch (Exception $e) {
            $this->logFlashThrow($e);
        }
    }

    public function deleteData($model)
    {
        try {
            return $model->delete();
        } catch (Exception $e) {
            $this->logFlashThrow($e);
        }
    }

    public function restoreData(int $id)
    {
        try {
            return $this->model::withTrashed()->find($id)->restore();
        } catch (Exception $e) {
            $this->logFlashThrow($e);
        }
    }

    public function forceDeleteData(int $id)
    {
        try {
            $user = User::where('id', $id)->withTrashed()->first();
            deleteImage($user->avatar, User::FILE_UPLOAD_PATH);
            return $user->forceDelete();
        } catch (Exception $e) {
            $this->logFlashThrow($e);
        }
    }
}
