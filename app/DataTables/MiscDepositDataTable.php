<?php

namespace App\DataTables;

use App\Helpers\PestPac;
use App\Models\MiscDeposit;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

/**
 *
 */
class MiscDepositDataTable extends DataTable
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
            ->editColumn( 'deposit_at', function( $row ) {
                return Carbon::make( $row->deposit_at )->format( 'm/d/Y' );
            } )
            ->editColumn( 'amount', function( $row ) {
                return '$' . number_format( $row->amount );
            } )
            ->editColumn( 'purpose', function( $row ) {
                if( mb_strlen( $row->purpose ) < 81 ) {
                    return $row->purpose;
                }
                $link = '<button type="button" class="btn btn-link btn-sm show-more">Show More ...</button>';
                $text = Str::limit( $row->purpose, 80, $link );
                $text .= '<div class="d-none">' . $row->purpose . '</div>';
                return $text;
            } )
            ->editColumn( 'created_at', function( $row ) {
                return Carbon::make( $row->created_at )->format( 'm/d/Y' );
            } )
            ->addColumn( 'user_name', static function( $row ) {
                return $row->user->name;
            } )
            ->addColumn( 'action', 'admin.misc-deposits.action' )
            ->rawColumns( [ 'purpose', 'action' ] );
    }

    /**
     * Get query source of dataTable.
     *
     * @param MiscDeposit $model
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query( MiscDeposit $model ) : \Illuminate\Database\Eloquent\Builder
    {
        return $model::with( [ 'branch', 'user' ] );
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
                    ->setTableId( 'deposit-table' )
                    ->columns( $this->getColumns() )
                    ->minifiedAjax()
                    ->dom( '<"card-header border-bottom p-1"<"head-label"><"dt-action-buttons text-right"B>><"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-2"l><"col-sm-12 col-md-10"f>><"table-responsive"t><"d-flex justify-content-between mx-0 mb-1 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>' )
                    ->orderBy( 7 )
                    ->stateSave( true )
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
            Column::make( 'branch.name' )->title( 'Branch' ),
            Column::make( 'gl_account_number' )->title( 'GL Account Number' ),
            Column::make( 'deposit_at' )->title( 'Deposit date' ),
            Column::make( 'amount' )->title( 'Amount' ),
            Column::make( 'vendor' )->title( 'Vendor' ),
            Column::make( 'purpose' )->title( 'Purpose' ),
            Column::make( 'user.name' )->title( 'User Name' ),
            Column::make( 'created_at' )->hidden(),
            Column::computed( 'action' )
                  ->width( '65px' )
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
        return 'Misc_Deposits_' . date( 'YmdHis' );
    }
}
