<?php

namespace App\DataTables;

use App\Models\User;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UsersDataTable extends DataTable
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
            ->addColumn( 'action', 'admin.users.action' )
            ->addColumn( 'roles', static function( $row ) {
                $roles = $row->roles->map( function( $role ) {
                    return $role->label;
                } );
                return '<li>' . implode( '</li><li>', $roles->toArray() ) . '</li>';
            } )
            ->addColumn( 'branches', static function( $row ) {
                $roles = $row->branches->map( function( $branch ) {
                    return $branch->name;
                } );
                return '<li>' . implode( '</li><li>', $roles->toArray() ) . '</li>';
            } )
            ->addColumn( 'azure', static function( $row ) {
                if( empty( $row->azure_id ) ) {
                    return '';
                }
                return '<i data-feather="check"></i>';
            } )
            ->rawColumns( [ 'roles', 'branches', 'action', 'azure' ] );
    }

    /**
     * Get query source of dataTable.
     *
     * @param User $model
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query( User $model )
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
                    ->setTableId( 'users-table' )
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
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make( 'name' )->title( 'Name' ),
            Column::make( 'email' ),
            Column::make( 'roles' )->title( 'Roles' ),
            Column::make( 'branches' )->title( 'Branches' ),
            Column::make( 'azure' )->title( 'Azure AD' ),
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
        return 'Users_' . date( 'YmdHis' );
    }
}
