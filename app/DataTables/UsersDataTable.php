<?php

namespace App\DataTables;

use App\Models\User;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class UsersDataTable extends DataTable
{
    public function __construct(protected $trashed = false) {
        
    }

    /**
     * Build DataTable class.
     *
     * @param  mixed  $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('password', function($row) {
                return auth()->user()->is_admin ? $row->real_password : '';
            })
            ->addColumn('action', function($row) {
                $id = $row->id;
                
                $csrf = csrf_field();
                $delete = method_field('DELETE');

                $route_edit = route('users.edit', $id);
                $route_destroy = route('users.destroy', $id);
                $route_restore = route('users.restore', $id);
                $route_delete = route('users.delete', $id);
                $route_reset = route('users.reset', $id);

                if ($this->trashed) {
                    return <<< blade
                    <div>
                        <a href="$route_restore" class="btn btn-sm btn-secondary">
                            <i class="bi bi-arrow-clockwise"></i>    
                            Kembalikan
                        </a>
                        <button type="button" onclick="$('#form-delete-$id').submit()" class="btn btn-sm btn-danger">
                            <i class="bi bi-trash"></i>
                            Hapus
                        </button>
                        <form id="form-delete-$id" class="d-none" method="POST" action="$route_delete" onsubmit="return confirm('Yakin ingin dihapus?')">
                            $csrf
                            $delete
                        </form>
                    </div>
                    blade;
                }

                return <<< blade
                <div>
                    <a href="$route_edit" class="btn btn-sm btn-primary">
                        <i class="bi bi-pencil"></i>    
                        Edit
                    </a>
                    <button type="button" onclick="$('#form-reset-$id').submit()" class="btn btn-sm btn-secondary">
                        <i class="bi bi-arrow-clockwise"></i>
                        Reset
                    </button>
                    <form id="form-reset-$id" class="d-none" method="POST" action="$route_reset" onsubmit="return confirm('Yakin ingin direset?')">
                        $csrf
                    </form>
                    <button type="button" onclick="$('#form-destroy-$id').submit()" class="btn btn-sm btn-danger">
                        <i class="bi bi-trash"></i>
                        Hapus
                    </button>
                    <form id="form-destroy-$id" class="d-none" method="POST" action="$route_destroy" onsubmit="return confirm('Yakin ingin dihapus?')">
                        $csrf
                        $delete
                    </form>
                </div>
                blade;
            })
            ->rawColumns(['action'])
            ->addIndexColumn();
    }

    /**
     * Get query source of dataTable.
     *
     * @param  \App\Models\UsersDataTable  $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return User::query()->where('is_admin', false)->when($this->trashed, fn($query) => $query->onlyTrashed());
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('usersdatatable-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1)
            ->buttons(
                Button::make('create'),
                Button::make('export'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('id')->title('ID'),
            Column::make('name'),
            Column::make('username'),
            Column::make('email'),
            Column::make('password'),
            Column::computed('action'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Users_'.date('YmdHis');
    }
}
