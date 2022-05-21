<?php

namespace App\DataTables;

use App\Helpers\PestPac;
use App\Models\Contract;
use App\Models\MiscDeposit;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

/**
 *
 */
class ContractsDataTable extends DataTable
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
            ->addColumn( 'action', 'admin.contracts.action' );
    }

    /**
     * Get query source of dataTable.
     *
     * @param Contract $model
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query( Contract $model )
    {
        $query = $model->newQuery()->doesntHave('deletedContracts');
        if( !Auth::user()->can( 'access signed contracts' ) ) {
            $query->unsigned();
        }
        return $query;
    }// query

    /**
     * Optional method if you want to use html builder.
     *
     * @param $value
     *
     * @return Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId( 'contracts-table' )
                    ->columns( $this->getColumns() )
                    ->minifiedAjax()
                    ->dom( '<"card-header border-bottom p-1"<"head-label"><"dt-action-buttons text-right"B>><"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-2"l><"col-sm-12 col-md-10"f>><"table-responsive"t><"d-flex justify-content-between mx-0 mb-1 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>' )
                    ->orderBy( 1 )
                    ->languageSearch( '' )
                    ->languageSearchPlaceholder( 'Search' )
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
            Column::make( 'customer_name' )->title( 'Customer' ),
            Column::make( 'created_at' )->title( 'Date' ),
            Column::make( 'business_name' )->title( 'Business' ),
            Column::make( 'service_address' )->title( 'Service Address' ),
            Column::make( 'email' )->title( 'Email' ),
            Column::make( 'account_number' )->title( 'Account Number' ),
            Column::make( 'phone_1' )->title( 'Phone 1' )->hidden(),
            Column::make( 'phone_2' )->title( 'Phone 2' )->hidden(),
            Column::make( 'attention_line' )->title( 'Attention Line' )->hidden(),
            Column::make( 'billing_address' )->title( 'Billing Address' )->hidden(),
            Column::make( 'status' ),
            Column::computed( 'action' )
                  ->exportable( false )
                  ->printable( false )
                  ->addClass( 'text-center' ),
        ];
    }// getColumns

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'contracts_' . date( 'YmdHis' );
    }
}
