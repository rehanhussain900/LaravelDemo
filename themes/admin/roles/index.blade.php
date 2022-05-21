@extends('admin.layouts.admin')
@section('title','Roles')
@section('heading','Roles')
@section('breadcrumb')
    <li class="breadcrumb-item active">Roles</li>
@endsection
@section('buttons')
    @can('add role')
        <button type="button" data-action="{{route('admin.roles.create')}}" id="add-module"
                class="btn btn-outline-primary waves-effect btn-sm-block">
            <i data-feather='plus'></i>
            <span>Add Role</span>
        </button>
    @endcan
    <button type="button" id="list-module"
            class="btn btn-outline-primary waves-effect btn-sm-block">
        <i data-feather='plus'></i>
        <span>Show All</span>
    </button>
@endsection

@section('content')
    <section id="roles">
        <div class="row">
            <div class="col-12">
                @include('admin.roles.edit')
                @include('admin.roles.overview')
            </div>
        </div>
    </section>
@endsection
@include('components.ajax')
@push('footer')
    {{$dataTable->scripts()}}
    <script>
      let formEdit = $('#form-edit')
      let sectionEdit = $('#section-edit')
      let sectionOverview = $('#section-overview')
      let tableDecorated = false
      $(document).ready(function () {
        window.LaravelDataTables['roles-table'].on('draw', function () {
          $(document).trigger('refresh.icons')
          AdminApp.adjustDataTables(window.LaravelDataTables['roles-table'])
        })
        AdminApp.toggleSection('add-module', 'list-module')

        /* --------------------------------------------------------------
         *  Cancel Form
         * --------------------------------------------------------------
         */
        AdminApp.$body.on('click', '#btnReset,#list-module', function () {
          AdminApp.toggleSection('section-overview', 'section-edit')
          AdminApp.toggleSection('add-module', 'list-module')
        })
        /* --------------------------------------------------------------
         *  Add Role
         * --------------------------------------------------------------
         */
        $('#add-module').on('click', function () {
          let el = $(this)
          formEdit.attr('method', 'POST')
          formEdit.attr('action', el.attr('data-action'))
          formEdit[0].reset()
          sectionEdit.find('.card-title').html('Add Role')
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
              $('#label').val(res.label)

              try {
                let permissions = res.permissions
                $.each(permissions, function (i, p) {
                  console.log(p)
                  $('[value="' + p + '"]').prop('checked', true)
                })
              } catch (err) {
                console.error(err)
              }

              formEdit.attr('method', 'PUT')
              formEdit.attr('action', el.attr('data-edit'))
              sectionEdit.find('.card-title').html('Edit Role')
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
              AdminApp.success(res.message)
              AdminApp.toggleSection('section-overview', 'section-edit')
              AdminApp.toggleSection('add-module', 'list-module')
              window.LaravelDataTables['roles-table'].ajax.reload()
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
          AdminApp.blockCard(el)

          Swal.fire({
            title: 'Are you sure?',
            text: 'You won\'t be able to revert this!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete the role!'
          }).then((result) => {
            if (result.isConfirmed) {
              $.ajax({
                url: el.attr('data-delete'),
                type: 'delete',
                dataType: 'json',
                success: function (res) {
                  AdminApp.success(res.message)
                  window.LaravelDataTables['roles-table'].ajax.reload(null, false)
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
      })// Document.ready
    </script>
@endpush