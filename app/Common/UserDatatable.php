<?php

namespace App\Common;

use App\Common\Datatables as CommonDatatables;
use App\Queries\UserQuery;
use Illuminate\Http\Request;
use LaravelCommon\App\Queries\Query;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Services\DataTable as ServicesDatatable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\EloquentDataTable;

class UserDatatable extends CommonDatatables
{

    /**
     * @var UserQuery
     */
    protected $query;

    /**
     * @var Request
     */
    protected $request;

    public function __construct(
        UserQuery $query,
        Request $request
    ) {

        $this->query = $query;
        $this->request = $request;
    }

    public function search()
    {
        $search = request()->search['value'];
        if ($search) {
            $this->query->orWhere(function($query) use ($search) {
                $query->orWhereName($search)
                    ->orWhereEmail($search);
            });
        }
    }

    public function build()
    {

        $this->query->whereIsDelete(false);

        $currentUser = $this->request->getCurrentUser();

        $this->addColumn('id', function ($row) {
            return $row->getId();
        })
            ->addColumn('name', function ($row) {
                return $row->getName();
            })
            ->addColumn('email', function ($row) {
                return $row->getEmail();
            })
            ->addColumn('password', function ($row) use ($currentUser) {
                if ($currentUser->getScope()->getId() != 1) {
                    return null;
                }
                return $row->getPassword();
            })
            ->addColumn('role', function ($row) {
                return $row->getScope()->getRole();
            })
            ->addColumn('action', function ($row) {
                $actionBtn = '<div class="btn-group">';
                $actionBtn .= '<a href=' . route("users.edit", ['user' => $row->getId()]) . ' class="btn btn-primary text-white" style="cursor:pointer;">Edit</a>';
                $actionBtn .= '<a href=' . route("users.delete", ['user' => $row->getId()]) . ' class="btn btn-danger text-white" style="cursor:pointer;">Delete</a>';
                // $actionBtn .= '<button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                //         data-toggle="dropdown">
                //         <span class="sr-only">Toggle Dropdown</span>
                //     </button>';
                // $actionBtn .= '<div class="dropdown-menu">
                //         <a class="dropdown-item" href="' . route('users.edit', $row->getId()) . '">Edit</a>';
                // $actionBtn .= '<a onclick="del(' . $row->getId() . ')" class="dropdown-item" style="cursor:pointer;">Hapus</a>';
                $actionBtn .= '</div></div>';

                return $actionBtn;
            });
        return $this;
    }
}
