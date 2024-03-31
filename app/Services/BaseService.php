<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class BaseService
{

    /**
     * @var Model
     */
    protected $model;

    /**
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $data
     * @param null $id
     * @return void
     */
    public function storeOrUpdate(array $data, $id = null)
    {
        try {
            // If contain id update data or create new data
            if ($id) {
                return $this->model::findOrFail($id)->update($data);
            } else {
                return $this->model::create($data);
            }
        } catch (\Exception $e) {
            $this->logFlashThrow($e);
        }
    }

    /**
     * @param $id
     * @param bool $own_data
     * @return mixed|void
     */
    public function delete($model)
    {
        try {
            return $model->delete();
        } catch (\Exception $e) {
            $this->logFlashThrow($e);
        }
    }

    /**
     * @param $id
     * @param bool $own_data
     * @return mixed|void
     */
    public function deleteOwn($id, bool $own_data = false)
    {
        try {
            $query = $this->model::query();
            $query->where('id', $id);
            // If contain id update data or create new data
            if ($own_data) {
                $query->where('user_id', Auth::id());
            }
            return $query->first()->delete();
        } catch (\Exception $e) {
            $this->logFlashThrow($e);
        }
    }

    /**
     * @param \Exception $e
     * @return mixed
     * @throws \Exception
     */
    public function logFlashThrow(\Exception $e)
    {
        log_error($e);
        something_wrong_toast();
        throw $e;
    }
}
?>
