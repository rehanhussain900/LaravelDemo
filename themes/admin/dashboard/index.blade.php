@extends('admin.layouts.admin')
@section('title','Dashboard')
@section('content')
    <!-- Dashboard Ecommerce Starts -->
    <section id="dashboard-ecommerce">
        <div class="row match-height">
            <div class="col-12">
                <div class="card card-statistics">
                    <div class="card-header">
                        <h4 class="card-title">Modules</h4>
                        <div class="d-flex align-items-center">
                            <p class="card-text font-small-2 mr-25 mb-0"></p>
                        </div>
                    </div>
                    <div class="card-body statistics-body">
                        <div class="row">
                            @can('access contracts')
                                <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
                                    <div class="media">
                                        <div class="avatar bg-light-primary mr-2">
                                            <div class="avatar-content">
                                                <span class="iconify" data-width="24" data-icon="mdi:file-sign"></span>
                                            </div>
                                        </div>
                                        <div class="media-body my-auto">
                                            <h4 class="font-weight-bolder mb-0">
                                                <a href="{{route('admin.contracts')}}">Contracts</a>
                                            </h4>
                                            <p class="card-text font-small-3 mb-0">Generate Dynamic Contracts</p>
                                        </div>
                                    </div>
                                </div>
                            @endcan
                            @can('access misc deposits')
                                <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
                                    <div class="media">
                                        <div class="avatar bg-light-info mr-2">
                                            <div class="avatar-content">
                                                <span class="iconify" data-icon="mdi:cash-fast" data-width="24"
                                                      data-height="24"></span>
                                            </div>
                                        </div>
                                        <div class="media-body my-auto">
                                            <h4 class="font-weight-bolder mb-0">
                                                <a href="{{route('admin.misc_deposits')}}">Misc Deposits</a>
                                            </h4>
                                            <p class="card-text font-small-3 mb-0">Manage Misc. Deposits</p>
                                        </div>
                                    </div>
                                </div>
                            @endcan
                            @can('access roles')
                                <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-sm-0">
                                    <div class="media">
                                        <div class="avatar bg-light-danger mr-2">
                                            <div class="avatar-content">
                                            <span class="iconify" data-icon="mdi:shield-account-outline" data-width="24"
                                                  data-height="24"></span>
                                            </div>
                                        </div>
                                        <div class="media-body my-auto">
                                            <h4 class="font-weight-bolder mb-0">
                                                <a href="{{route('admin.roles')}}">Roles</a>
                                            </h4>
                                            <p class="card-text font-small-3 mb-0">Roles and Permissions</p>
                                        </div>
                                    </div>
                                </div>
                            @endcan
                            @can('access users')
                                <div class="col-xl-3 col-sm-6 col-12">
                                    <div class="media">
                                        <div class="avatar bg-light-success mr-2">
                                            <div class="avatar-content">
                                                <i data-feather="users" class="avatar-icon"></i>
                                            </div>
                                        </div>
                                        <div class="media-body my-auto">
                                            <h4 class="font-weight-bolder mb-0">Users</h4>
                                            <p class="card-text font-small-3 mb-0">Manage Users</p>
                                        </div>
                                    </div>
                                </div>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Dashboard Ecommerce ends -->
@endsection