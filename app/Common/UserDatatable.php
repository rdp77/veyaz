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

class UserDatatable extends CommonDatatables {
    
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
    )
    {
        
        $this->query = $query;
        $this->request = $request;
    }

    public function search()
    {
        $search = request()->search['value'];
        if($search)
        {
            $this->query->orWhereName($search);
            $this->query->orWhereEmail($search);
        }
    }

    public function build() {

        $currentUser = $this->request->getCurrentUser();

        $this->addColumn('id', function($row) {
            return $row->getId();
        })
        ->addColumn('name', function($row) {
            return $row->getName();
        })
        ->addColumn('email', function($row) {
            return $row->getEmail();
        })
        ->addColumn('password', function($row) use ($currentUser) {
            if($currentUser->getScope()->getId() != 1) {
                return null;
            }
            return $row->getPassword();
        })
        ->addColumn('role', function($row) {
            return $row->getScope()->getRole();
        });
        return $this;
    }


    
}