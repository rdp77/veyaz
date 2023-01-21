<?php

namespace App\Common;

use App\Common\Datatables as CommonDatatables;
use App\Queries\UserQuery;
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

    public function __construct(
        UserQuery $query
    )
    {
        
        $this->query = $query;
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

        $this->addColumn('id', function($row) {
            return $row->getId();
        })
        ->addColumn('name', function($row) {
            return $row->getName();
        })
        ->addColumn('email', function($row) {
            return $row->getEmail();
        })
        ->addColumn('action', function($row) {
            return 'sdasd';
        });
        return $this;
    }


    
}