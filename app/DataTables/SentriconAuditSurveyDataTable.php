<?php

namespace App\DataTables;

use App\Models\QualityAssuranceSurvey;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\Auth;

class SentriconAuditSurveyDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', 'admin.quality-assurance-surveys.sentricon-audit.actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\QualityAssuranceSurvey $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(QualityAssuranceSurvey $model)
    {
        $query = $model->where('type','Sentricon Audit')->orderBy('created_at' , 'DESC')->newQuery();
        if( !Auth::user()->can( 'access qas' ) ) {
            $query->unsigned();
        }
        return $query;
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('sentriconauditsurveydatatable-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom( '<"card-header border-bottom p-1"<"head-label"><"dt-action-buttons text-right"B>><"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-2"l><"col-sm-12 col-md-10"f>><"table-responsive"t><"d-flex justify-content-between mx-0 mb-1 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>' )
                    ->orderBy( 1 )
                    ->languageSearch( '' )
                    ->languageSearchPlaceholder( 'Search' )
                    ->buttons(
                        // Button::make('create'),
                        // Button::make('export'),
                        // Button::make('print'),
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
            Column::make('customer_name'),
            Column::make('account_number'),
            Column::make('audit_date'),
            Column::make('survey_date')->hidden(),
            Column::computed('action')
            ->exportable(false)
            ->printable(false)
            ->width(60)
            ->addClass('text-center')
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'SentriconAuditSurvey_' . date('YmdHis');
    }
}
