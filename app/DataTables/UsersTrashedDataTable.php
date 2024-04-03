<?php

namespace App\DataTables;

use App\Models\User;
use Illuminate\Support\Str;
use App\Utils\GlobalConstant;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class UsersTrashedDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($query) {
                $buttons = '';
                $buttons .= '<form action="' . route('users.soft-restore', $query->id) . '" method="POST">
                    <input type="hidden" name="_token" value="' . csrf_token() . '">
                    <button type="submit"
                        class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm p-2.5 me-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                        <i class="ri-restart-line"></i>
                    </button>
                </form>';

                $buttons .= '<form action="' . route('users.force-destroy', $query->id) . '"  id="delete-form-' . $query->id . '" method="POST">
                    <input type="hidden" name="_token" value="' . csrf_token() . '">
                    <input type="hidden" name="_method" value="DELETE">
                    <button class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800" onclick="return makeDeleteRequest(event, ' . $query->id . ')"  type="submit">
                        <i class="ri-delete-bin-6-line"></i>
                    </button>
                </form>';

                return '
                <div class="flex">
                ' . $buttons . '
                </div>';
            })
            ->editColumn('status', function ($query) {
                $class = $query->status == GlobalConstant::STATUS_ACTIVE ? "bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300" : "bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300";
                return '<span class="' . $class . '">' . Str::upper($query->status) . '</span>';
            })
            ->editColumn('status', function ($query) {
                $class = $query->status == GlobalConstant::STATUS_ACTIVE ? "bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300" : "bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300";
                return '<span class="' . $class . '">' . Str::upper($query->status) . '</span>';
            })
            ->editColumn('phone', function ($query) {
                return $query->phone ? $query->phone : "N/A";
            })
            ->rawColumns(['phone', 'status', 'action'])
            ->addIndexColumn();
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(User $model): QueryBuilder
    {
        return $model->newQuery()->onlyTrashed()->orderBy('id', 'desc');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('userstrashed-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->dom('Bfrtip')
            ->orderBy(1)
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),
                Button::make('reload')
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::computed('DT_RowIndex', 'SL#')->width(70),
            Column::make('name')->title('Full Name'),
            Column::make('email')->width(300),
            Column::make('phone')->title('Mobile'),
            Column::make('status')->width(200),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(100)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'UsersTrashed_' . date('YmdHis');
    }
}
