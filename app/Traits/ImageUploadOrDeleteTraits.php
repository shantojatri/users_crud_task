<?php

namespace App\Traits;

trait ImageUploadOrDeleteTraits
{
    public function uploadImage($request, $inputName, $path, $old = null){
        $filePath = '/app/public/'. $path .'/';

        if ($request->hasFile($inputName)) {
            $file = $request->file($inputName);

            if ($old && $old->$inputName) {
                try {
                    unlink(storage_path($filePath) . $old->$inputName);
                } catch (\Exception $e) {
                }
            }

            $extension = $file->getClientOriginalExtension();
            $imageName = uniqid() . '-' . time() . '.' . $extension;
            $file->move(storage_path() . $filePath, $imageName);

            return $imageName;
        } else {
            // When update without image
            if ($old) {
                return $old->$inputName;
            }
        }
    }

    public function deleteImage($file_path, $model, $field){
        if ($model->$field) {
            try {
                unlink(storage_path('/app/public/'.$file_path.'/'). $model->$field);
            } catch (\Exception $e) {
            }
        }
        return $model->delete();
    }
}
?>
