@extends('admin.layouts.admin')
@section('title','Quality Assurance Surveys | Field Audit')
@section('heading','Quality Assurance Surveys | Field Audit')
@section('breadcrumb')
    <li class="breadcrumb-item active">Quality Assurance Surveys | Field Audit</li>
@endsection
@section('buttons')
    {{--@can('add contract')
        <a href="{{route('admin.contracts.create')}}"
           class="btn btn-outline-primary waves-effect btn-sm-block">
            <i data-feather='plus'></i>
            <span>Generate Contract</span>
        </a>
    @endcan--}}
@endsection

@section('content')
    @php($expand=true)
    <section id="qas">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                       
                    </div>
                   
                    <div class="card-body" id="survey-body">
                        @include("admin.quality-assurance-surveys.field-audit.overview")
                    </div>
                </div>
            </div>
        </div>
        <!-- Right Sidebar starts -->
        
        <!-- Right Sidebar ends -->
    </section>
@endsection

@include('components.ajax')
@include('components.date-picker')
@push('head')
    <style>

    </style>
@endpush

@push('footer')
    {{$dataTable->scripts()}}
    <script>
      let tableDecorated = false

      $(document).ready(function () {
        window.LaravelDataTables['fieldauditsurveydatatable-table'].on('draw', function () {
          $(document).trigger('refresh.icons')
          columnToggleButton(window.LaravelDataTables['fieldauditsurveydatatable-table'])
        })
      });

      function columnToggleButton (table) {
        let $tag
        /* --------------------------------------------------------------
         *  Arrange the Buttons and UI
         * --------------------------------------------------------------
         */
        let $filter_wrapper = $('.dataTables_filter')
        /* --------------------------------------------------------------
         *  Arrange Search
         * --------------------------------------------------------------
         */
        $filter_wrapper.find('input').attr('placeholder', 'Search')

        let $actionButtons = $('.dt-action-buttons')
        if (!$filter_wrapper.find('.btnColToggle').length) {
          $filter_wrapper.append('<div class="btn-group btnColToggle"><button class="btn btn-sm btn-secondary dropdown-toggle" type="button" id="colVisBtn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Column Visibility </button></div>')
        }
        if (!tableDecorated) {
          let $btnDt = $actionButtons.find('.dt-buttons')
          $btnDt.addClass('btn-group-sm')
          let $exportBtn = ''
          $btnDt.prepend($exportBtn)
          $tag = $('<div class="btn-group btn-group-sm"></div>')
          $tag.append($('.buttons-reload'))
          $tag.append($('.buttons-reset'))
          $filter_wrapper.prepend($tag)
        }

        let options = $('<ul class="dropdown-menu col-vis-menu" aria-labelledby="colVisBtn"></ul>')
        table.columns().every(function () {
          let index = this.index()
          let title = $(this.header()).text()
          let visible = this.visible() ? 'checked' : ''
          options.append('<li><label class="dropdown-item"><input type="checkbox" data-dt="' + index + '" ' + visible + '> <span>' + title + '</span></label></li>')
        })
        $('.btnColToggle .dropdown-menu').remove()
        $('.btnColToggle').append(options)

        tableDecorated = true
      }
    </script>
@endpush