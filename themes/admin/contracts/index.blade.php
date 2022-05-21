@extends('admin.layouts.admin')
@section('title','Contracts')
@section('heading','Contracts')
@section('breadcrumb')
    <li class="breadcrumb-item active">Contracts</li>
@endsection
@section('buttons')
    @can('add contract')
        <a href="{{route('admin.contracts.create')}}"
           id="add-module"
           class="btn btn-outline-primary waves-effect btn-sm-block">
            <i data-feather='plus'></i>
            <span>Generate Contract</span>
        </a>
    @endcan
@endsection

@section('content')
    @can('edit contract')
        <section id="edit-contracts">
            <div class="row">
                <div class="col-12" id="contract-edit-view">
                </div>
            </div>
        </section>
    @endcan
    @can('access contracts')
        <section id="contracts">
            <div class="row">
                <div class="col-12">
                    @include('admin.contracts.overview')
                </div>
            </div>
        </section>
    @endcan
@endsection

@include('components.ajax')

@push('head')
    <style>
        #edit-contracts {
            display: none;
        }

        .segment-card {
            padding-top: 10px;
            padding-bottom: 10px;
            font-size: 1.2rem;
        }
    </style>
@endpush

@push('footer')
    {{$dataTable->scripts()}}
    <script>
      let tableDecorated = false

      $(document).ready(function () {
        window.LaravelDataTables['contracts-table'].on('draw', function () {
          $(document).trigger('refresh.icons')
          columnToggleButton(window.LaravelDataTables['contracts-table'])
        })

        /* --------------------------------------------------------------
         *  Add responsive method for Deposit button
         * --------------------------------------------------------------
         */
        ResponsiveElement.setFunction(function (resEl) {
          let $btn = $('#add-module')
          if (resEl.screenWidth < 930 && resEl.screenWidth > 767) {
            $btn.addClass('btn-sm').find('svg').hide()
          } else {
            $btn.removeClass('btn-sm').find('svg').show()
          }
        })
      })

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
          let $exportBtn = '<button class="btn btn-outline-secondary" type="button" disabled="">Export</button>'
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

      AdminApp.$body.on('click', '[data-dt]', function () {
        let i = $(this).attr('data-dt')
        let v = $(this).prop('checked')
        window.LaravelDataTables['contracts-table'].column(i).visible(v)
      })
      AdminApp.$body.on('click', '.btnColToggle .dropdown-item', function (e) {
        e.stopPropagation()
      })

      /* --------------------------------------------------------------
       *  Edit/Update
       * --------------------------------------------------------------
       */
      AdminApp.$body.on('click', '[data-edit]', function () {
        let $el = $(this)

        $.ajax({
          url: $el.attr('data-edit'),
          type: 'patch',
          dataType: 'json',
          success: function (res) {
            console.log(res)
            $('#contract-edit-view').html(res.view)
            AdminApp.toggleSection('edit-contracts', 'contracts')
          },
          error: function (err) {
            AdminApp.ajaxError(err)
          }
        })

      })

      /* --------------------------------------------------------------
       *  Delete
       * --------------------------------------------------------------
       */
      $('body').on('click', '[data-delete]', function (e) {
        e.preventDefault()
        let el = $(this)
        Swal.fire({
          title: 'Are you sure?',
          text: 'You won\'t be able to revert this!',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete the Contract!'
        }).then((result) => {
          if (result.isConfirmed) {
            AdminApp.blockCard(el)
            $.ajax({
              url: el.attr('data-delete'),
              type: 'delete',
              dataType: 'json',
              success: function (res) {
                AdminApp.success(res.message)
                window.LaravelDataTables['contracts-table'].ajax.reload(null, false)
              },
              error: function (err) {
                AdminApp.error(err)
              },
              complete: function () {
                AdminApp.unblockCard(el)
              }
            })
          }
        })
      })// data-delete

      /* --------------------------------------------------------------
       *  Send Invoice 
       * --------------------------------------------------------------
       */
       AdminApp.$body.on('click', '[data-send]', function () {
        let el = $(this)

        AdminApp.blockCard(el)
        $.ajax({
          url: el.attr('data-send'),
          type: 'get',
          dataType: 'json',
          success: function (res) {
            AdminApp.success(res.message)
          },
          error: function (err) {
            AdminApp.error(err)
          },
          complete: function () {
            AdminApp.unblockCard(el)
          }
        })
      })
    </script>
@endpush
