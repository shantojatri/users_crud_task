<?php

namespace App\Services;

use Exception;
use App\Utils\GlobalConstant;

class ImageUploadService
{

    public function uploadImage($request, $inputName, $path, $old = null)
    {
        $filePath = GlobalConstant::GLOBAL_PUBLIC_PATH . $path . '/';

        // if ($old) return $old->$inputName;

        // if(is_null($request->$inputName)){
        //     return $old ? $old->$inputName : null;
        // }

        if ($request->hasFile($inputName)) {
            $file = $request->file($inputName);

            if ($old && $old->$inputName) {
                try {
                    unlink(storage_path($filePath) . $old->$inputName);
                } catch (Exception $e) {
                    log_error($e);
                }
            }

            $extension = $file->getClientOriginalExtension();
            $imageName = uniqid() . '-' . time() . '.' . $extension;
            $file->move(storage_path() . $filePath, $imageName);

            return $imageName;
        }
        else{
            return $old ? $old->$inputName : null;
        }
    }

    /**
     * @param Exception $e
     * @return mixed
     * @throws Exception
     */
    public function logFlashThrow(Exception $e)
    {
        log_error($e);
        something_wrong_flash();
        throw $e;
    }
}
