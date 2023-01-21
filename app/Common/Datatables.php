<?php

namespace App\Common;

use Exception;
use LaravelCommon\App\Queries\Query;
use LaravelCommon\ViewModels\PaggedCollection;
use LaravelOrm\Entities\EntityList;
use LaravelOrm\Libraries\Datatables as LibrariesDatatables;
use Yajra\DataTables\DataTables as DataTablesDataTables;

abstract class Datatables
{

    /**
     * @var Query
     */
    protected $query;

    protected $page;
    protected $size;
    protected $offset;

    /**
     * @var array
     */
    protected $output = [
        'draw'            => null,
        'recordsTotal'    => null,
        'recordsFiltered' => null,
        'data'            => null,
    ];

    protected $columns = [];

    protected $useIndex = false;

    public function setDefaultRequest()
    {
        $this->page = (request()->start / request()->length) + 1;
        $this->size = request()->length;
        $this->offset = ($this->page - 1) *  $this->size;
        $this->query->limit($this->size);
        $this->query->offset($this->offset);
        // ($limit['page'] - 1) *  $limit['size']
    }

    protected function setUseIndex(bool $useIndex)
    {
        $this->useIndex = $useIndex;
    }

    public function populate()
    {
        try {

            $this->search();
            $this->setDefaultRequest();
            $this->build();

            $result = $this->query->getIterator();
            $collectionClass = $this->query->collectionClass();
            $collection = new $collectionClass($result, request());
            $collection->setPage($this->page);
            $collection->setSize($this->size);
            $collection->setTotalRecord($this->query->count());

            $this->output['draw']            = !empty(request()->draw) ? intval(request()->draw) : 0;
            $this->output['recordsTotal']    = intval ($collection->getSize());
            $this->output['recordsFiltered'] = intval($collection->getTotalRecord());
            $this->output['data']            = $this->output($result, $collection->getPage(), $collection->getSize());
        } catch (Exception $e) {
            $this->output['error'] = $e->getMessage();
        }

        return $this->output;
    }

    /**
     * build returned query
     *
     * @return $this
     */
    abstract function build();

    /**
     * 
     *
     * @return void
     */
    abstract function search();

    /**
     * Get the data
     *
     * @param PaggedCollection $source
     */
    private function output($source, $page, $size)
    {
            $out = [];
        $i   =  ($page * $size) - $size;
        foreach ($source as $data) {
            $row = [];
            foreach ($this->columns as $column) {
                $rowdata = null;

                if (!is_null($column['callback'])) {
                    $fn      = $column['callback'];
                    $rowdata = $fn($data, $i);
                } else {
                    $rowdata = $data;
                }

                if ($this->useIndex) {
                    $row[] = $rowdata;
                } else {
                    $selectedColumn = '';
                    $col            = explode('.', $column['column']);
                    if (count($col) === 3) {
                        $selectedColumn = $col[2];
                    } elseif (count($col) === 2) {
                        $selectedColumn = $col[1];
                    } else {
                        $selectedColumn = $col[0];
                    }
                    $row[$selectedColumn] = $rowdata;
                }


                $row['DT_RowId'] = $data->getId();

                // $row['DT_RowClass'] = $this->dtRowClass;
            }
            $i++;
            $out[] = $row;
        }
        return $out;
    }

    public function addColumn(string $column, $callback)
    {
        $this->columns[] = [
            'column' => $column, 
            'callback' =>  $callback
        ];
        return $this;
    }
}
