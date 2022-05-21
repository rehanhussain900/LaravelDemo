@extends('admin.layouts.admin')
@section('title','Users')
@section('heading','Users')
@section('breadcrumb')
    <li class="breadcrumb-item active">Users</li>
@endsection
@section('buttons')
    @can('add user')
        <button type="button" data-action="{{route('admin.users.create')}}" id="add-module"
                class="btn btn-outline-primary waves-effect btn-sm-block">
            <i data-feather='plus'></i>
            <span>Add User</span>
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
                @include('admin.users.edit')
                @include('admin.users.overview')
            </div>
        </div>
    </section>
@endsection
@include('components.ajax')
@push('footer')
    {{$dataTable->scripts()}}
    <script>
      'use strict'
      let formEdit = $('#form-edit')
      let sectionEdit = $('#section-edit')
      let sectionOverview = $('#section-overview')
      let tableDecorated = false
      $(document).ready(function () {
        window.LaravelDataTables['users-table'].on('draw', function () {
          $(document).trigger('refresh.icons')
          AdminApp.adjustDataTables(window.LaravelDataTables['users-table'])
        })
        AdminApp.toggleSection('add-module', 'list-module')
        $('#roles').select2()
        $('#branches').select2()

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
          $('#roles').val('').trigger('change')
          $('#branches').val('').trigger('change')
          sectionEdit.find('.card-title').html('Add User')
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
              $('#name').val(res.name)
              $('#email').val(res.email)
              $('#description').val(res.description)
              $('#roles').val('').val(res.role_ids).trigger('change')
              $('#branches').val('').val(res.branch_ids).trigger('change')

              formEdit.attr('method', 'PUT')
              formEdit.attr('action', el.attr('data-edit'))
              sectionEdit.find('.card-title').html('Edit User')
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
              window.LaravelDataTables['users-table'].ajax.reload()
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
            confirmButtonText: 'Yes, delete the user!'
          }).then((result) => {
            if (result.isConfirmed) {
              $.ajax({
                url: el.attr('data-delete'),
                type: 'delete',
                dataType: 'json',
                success: function (res) {
                  AdminApp.success(res.message)
                  window.LaravelDataTables['users-table'].ajax.reload(null, false)
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