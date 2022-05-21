@extends('admin.layouts.admin')
@section('title','Misc Deposits')
@section('heading','Misc Deposits')
@section('breadcrumb')
    <li class="breadcrumb-item active">Misc Deposits</li>
@endsection
@section('buttons')
    @can('add misc deposit')
        <button type="button" data-action="{{route('admin.misc_deposits.create')}}" id="add-module"
                class="btn btn-outline-primary waves-effect btn-sm-block">
            <i data-feather='plus'></i>
            <span>Add Misc Deposit</span>
        </button>
    @endcan
    <button type="button" id="list-module"
            class="btn btn-outline-primary waves-effect btn-sm-block">
        <i data-feather='plus'></i>
        <span>Show All</span>
    </button>
@endsection

@section('content')
    <section id="section-users">
        <div class="row">
            <div class="col-12">
                @include('admin.misc-deposits.edit')
                @include('admin.misc-deposits.overview')
            </div>
        </div>
    </section>
@endsection
@include('components.ajax')
@include('components.date-picker')
@include('components.input-mask')
@push('footer')
    {{$dataTable->scripts()}}
    <script>
      'use strict'
      let formEdit = $('#form-edit')
      let sectionEdit = $('#section-edit')
      let sectionOverview = $('#section-overview')
      let tableDecorated = false
      $(document).ready(function () {
        /* --------------------------------------------------------------
         *  Disable Confirm view
         * --------------------------------------------------------------
         */
        toggleConfirmView(false)
        /* --------------------------------------------------------------
         *  Input Mask
         * --------------------------------------------------------------
         */
        $('#gl_account_number').inputmask({ mask: '9{0,5}', greedy: false })
        window.LaravelDataTables['deposit-table'].on('draw', function () {
          $(document).trigger('refresh.icons')
          AdminApp.adjustDataTables(window.LaravelDataTables['deposit-table'])
        })
        AdminApp.toggleSection('add-module', 'list-module')
        $('#roles').select2()

        /* --------------------------------------------------------------
         *  Cancel Form
         * --------------------------------------------------------------
         */
        AdminApp.$body.on('click', '#btnReset,#list-module', function () {
          AdminApp.toggleSection('section-overview', 'section-edit')
          AdminApp.toggleSection('add-module', 'list-module')
          toggleConfirmView(false)
        })

        /* --------------------------------------------------------------
         *  Review back button
         * --------------------------------------------------------------
         */
        $('#btnBackEdit').on('click', function () {
          toggleConfirmView(false)
        })
        /* --------------------------------------------------------------
         *  Add Misc Deposit
         * --------------------------------------------------------------
         */
        $('#add-module').on('click', function () {
          let el = $(this)
          formEdit.attr('method', 'POST')
          formEdit.attr('action', el.attr('data-action'))
          formEdit[0].reset()
          $('#roles').val('').trigger('change')
          sectionEdit.find('.card-title').html('Add Misc Deposit')
          toggleConfirmView(false)
          AdminApp.toggleSection('section-edit', 'section-overview')
          AdminApp.toggleSection('list-module', 'add-module')
        })

        /* --------------------------------------------------------------
         *  Edit
         * --------------------------------------------------------------
         */
        AdminApp.$body.on('click', '[data-edit]', function (e) {
          e.preventDefault()
          let el = $(this)
          AdminApp.blockCard(el)
          $.ajax({
            url: el.attr('data-edit'),
            type: 'patch',
            dataType: 'json',
            success: function (res) {
              formEdit[0].reset()

              /* --------------------------------------------------------------
               *  Assign values to Fields
               * --------------------------------------------------------------
               */
              $('#branch').val(res.branch_id)
              $('#gl_account_number').val(res.gl_account_number)
              document.querySelector('#deposit-date')._flatpickr.setDate(res.deposit_at)
              $('#amount').val(res.amount)
              $('#vendor').val(res.vendor)
              $('#purpose').val(res.purpose)

              formEdit.attr('method', 'PUT')
              formEdit.attr('action', el.attr('data-edit'))
              sectionEdit.find('.card-title').html('Edit Misc Deposit')
              AdminApp.toggleSection('section-edit', 'section-overview')
              AdminApp.toggleSection('list-module', 'add-module')
            },
            error: function (err) {
              AdminApp.ajaxError(err)
            },
            complete: function () {
              AdminApp.unblockCard(el)
            }
          })
        })// [data-edit]

        /* --------------------------------------------------------------
         *      Form Submit
         * --------------------------------------------------------------
         */
        formEdit.on('submit', function (e) {
          e.preventDefault()
          let el = $(this)
          AdminApp.blockCard(el)

          $.ajax({
            url: formEdit.attr('action'),
            data: formEdit.serialize(),
            type: formEdit.attr('method'),
            dataType: 'json',
            success: function (res) {
              if (res.status === 'not confirmed') {
                toggleConfirmView(true, res.view)
                return
              }
              AdminApp.success(res.message)
              AdminApp.toggleSection('section-overview', 'section-edit')
              AdminApp.toggleSection('add-module', 'list-module')
              window.LaravelDataTables['deposit-table'].ajax.reload()
            },
            error: function (err) {
              AdminApp.ajaxError(err)
            },
            complete: function () {
              AdminApp.unblockCard(el)
            }
          })
        })// form.submit

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
            confirmButtonText: 'Yes, delete the user!'
          }).then((result) => {
            if (result.isConfirmed) {
              AdminApp.blockCard(el)
              $.ajax({
                url: el.attr('data-delete'),
                type: 'delete',
                dataType: 'json',
                success: function (res) {
                  AdminApp.success(res.message)
                  window.LaravelDataTables['deposit-table'].ajax.reload(null, false)
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
         *  Add responsive method for Deposit button
         * --------------------------------------------------------------
         */
        ResponsiveElement.setFunction(function (resEl) {
          let $btn = $('#add-module')
          if (resEl.screenWidth < 890 && resEl.screenWidth > 767) {
            $btn.addClass('btn-sm').find('svg').hide()
          } else {
            $btn.removeClass('btn-sm').find('svg').show()
          }
        })
      })// Document.ready

      function toggleConfirmView (showConfirm, content) {
        if (showConfirm === undefined || showConfirm === null) {
          showConfirm = false
        }
        let $viewEditor = $('#editor-view')
        let $viewConfirm = $('#confirm-view')
        let $btnReview = $('#btnReview')
        let $btnSave = $('#btnSave')
        let $btnBack = $('#btnBackEdit')
        let $confirmed = $('#confirmed')

        if (showConfirm) {
          $viewEditor.hide()
          $viewConfirm.show().html(content)
          $btnReview.hide()
          $btnSave.show()
          $btnBack.show()
          $confirmed.val(1)
        } else {
          $viewEditor.show()
          $viewConfirm.hide()
          $btnReview.show()
          $btnSave.hide()
          $btnBack.hide()
          $confirmed.val('')
        }

      }

      AdminApp.$body.on('click', '.show-more', function (e) {
        e.preventDefault()
        let $el = $(this)
        Swal.fire({
          title: '',
          text: $el.siblings('.d-none').html(),
        })
      })

    </script>
@endpush
