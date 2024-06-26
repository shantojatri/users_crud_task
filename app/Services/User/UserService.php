<?php

namespace App\Services\User;

use DB;
use Exception;
use App\Models\User;
use App\Events\UserCreated;
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
            if(isset($request->avatar)){
                $imageName = $this->uploadImage($request, self::IMAGE_INPUT_NAME, User::FILE_UPLOAD_PATH);
                $data['avatar'] = $imageName;
            }

            DB::beginTransaction();
            try {
                $user = $this->model::create($data);

                $addressArr =[
                    'user_id' => $user->id,
                    'address' => $data['addresses'],
                ];
                event(new UserCreated($addressArr));

                DB::commit();
            } catch (Exception $e) {
                log_error($e);
                deleteImage($user->avatar, User::FILE_UPLOAD_PATH);
                DB::rollback();
            }

            return true;
        } catch (Exception $e) {
            $this->logFlashThrow($e);
        }
    }

    public function updateData(Request $request, array $data, Model $model)
    {
        try {
            if($request['password']){
                $data['password'] = Hash::make($data['password']);
            } else{
                $data['password'] = $model->password;
            }

            if (isset($request->avatar)) {
                $imageName = $this->uploadImage($request, self::IMAGE_INPUT_NAME, User::FILE_UPLOAD_PATH, $model);
                $data['avatar'] = $imageName;
            }

            DB::beginTransaction();
            try {
                $model->update($data);

                $addressArr = [
                    'user_id' => $model->id,
                    'address' => $data['addresses'],
                ];
                event(new UserCreated($addressArr));

                DB::commit();
            } catch (Exception $e) {
                log_error($e);
                deleteImage($model->avatar, User::FILE_UPLOAD_PATH);
                DB::rollback();
            }

            return true;
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
