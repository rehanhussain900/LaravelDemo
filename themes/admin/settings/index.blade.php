@extends('admin.layouts.admin')
@section('title','Settings')
@section('heading','Settings')
@section('breadcrumb')
    <li class="breadcrumb-item active">Settings</li>
@endsection

@section('content')
    <section id="section-users">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                    </div>
                    <div class="card-body">
                        <form action="{{route('admin.settings')}}" method="post" id="form-settings">
                            @csrf
                            @method('put')
                            <div class="nav-vertical">
                                <ul class="nav nav-tabs nav-left flex-column" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="general-tab" data-toggle="tab"
                                           aria-controls="general-settings" href="#general-settings" role="tab"
                                           aria-selected="true">General</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="azure-tab" data-toggle="tab"
                                           aria-controls="azure-settings" href="#azure-settings" role="tab"
                                           aria-selected="false">Azure AD</a>
                                    </li>
                                    {{--<li class="nav-item">
                                        <a class="nav-link" id="baseVerticalLeft-tab3" data-toggle="tab"
                                           aria-controls="tabVerticalLeft3" href="#tabVerticalLeft3" role="tab"
                                           aria-selected="false">Tab 3
                                        </a>
                                    </li>--}}
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="general-settings" role="tabpanel"
                                         aria-labelledby="general-tab">
                                        <div class="form-group">
                                            <label for="app-name">App Name</label>
                                            <input type="text"
                                                   name="settings[app.name]"
                                                   id="app-name"
                                                   class="form-control"
                                                   value="{{option('app.name')}}"
                                            >
                                        </div>
                                        <div class="form-group">
                                            <label for="app-email">App Email</label>
                                            <input type="text"
                                                   name="settings[app.email]"
                                                   id="app-email"
                                                   class="form-control"
                                                   value="{{option('app.email')}}"
                                            >
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="azure-settings" role="tabpanel"
                                         aria-labelledby="azure-tab">
                                        <div class="form-group">
                                            <label for="azure-fb-role">Fallback Role</label>
                                            <input type="text"
                                                   name="settings[azure.fallback.role]"
                                                   id="app-name"
                                                   class="form-control"
                                                   value="{{option('azure.fallback.role')}}"
                                            >
                                        </div>
                                        <div class="form-group">
                                            <label for="azure-domain">Restricted Domain</label>
                                            <input type="text"
                                                   name="settings[azure.restricted.domain]"
                                                   id="app-name"
                                                   class="form-control"
                                                   value="{{option('azure.restricted.domain')}}"
                                            >
                                        </div>
                                        <div class="form-group">
                                            <label for="azure-restricted-message">Message for Restricted users</label>
                                            <textarea name="settings[azure.restricted.message]"
                                                      id="azure-restricted-message"
                                                      class="form-control"
                                                      rows="3">{{option('azure.restricted.message')}}</textarea>
                                        </div>
                                    </div>
                                    {{--<div class="tab-pane" id="tabVerticalLeft3" role="tabpanel"
                                         aria-labelledby="baseVerticalLeft-tab3">
                                        <p>
                                            Icing croissant powder jelly bonbon cake marzipan fruitcake. Tootsie roll
                                            marzipan tart marshmallow
                                            pastry cupcake chupa chups cookie. Fruitcake dessert lollipop pudding jelly.
                                            Cookie dragée jujubes
                                            croissant lemon drops cotton candy. Carrot cake candy canes powder donut
                                            toffee
                                            cookie.
                                        </p>
                                    </div>--}}
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer">
                        <button type="submit" form="form-settings" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@include('components.ajax')
@include('components.alerts')
@push('footer')
    <script>
      $(document).ready(function () {

      })// Document.ready
    </script>
@endpush