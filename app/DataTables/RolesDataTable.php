<?php

namespace App\DataTables;

use App\Models\Role;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class RolesDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     *
     * @return DataTableAbstract
     */
    public function dataTable( $query )
    {
        return datatables()
            ->eloquent( $query )
            ->addColumn( 'action', 'admin.roles.action' );
    }

    /**
     * Get query source of dataTable.
     *
     * @param Role $model
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query( Role $model )
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return Builder
     */
    public function html()
    {
        return $this->builder()
                    ->languageSearch( '' )
                    ->languageSearchPlaceholder( 'Search' )
                    ->responsive( true )
                    ->setTableId( 'roles-table' )
                    ->columns( $this->getColumns() )
                    ->minifiedAjax()
                    ->dom( '<"card-header border-bottom p-1"<"head-label"><"dt-action-buttons text-right"B>><"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-2"l><"col-sm-12 col-md-10"f>><"table-responsive"t><"d-flex justify-content-between mx-0 mb-1 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>' )
                    ->orderBy( 1 )
                    ->buttons(
                        Button::make( 'csv' ),
                        Button::make( 'excel' ),
                        Button::make( 'print' ),
                        Button::make( 'reset' ),
                        Button::make( 'reload' )
                    );
    }// html

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make( 'label' )->title( 'Name' ),
            Column::make( 'created_at' ),
            Column::make( 'updated_at' ),
            Column::computed( 'action' )
                  ->exportable( false )
                  ->printable( false )
                  ->addClass( 'text-center' ),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Roles_' . date( 'YmdHis' );
    }
}
