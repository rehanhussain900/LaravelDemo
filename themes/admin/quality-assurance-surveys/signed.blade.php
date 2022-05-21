@extends('admin.layouts.admin')

@section('title','Survey Signed')
@section('heading','Survey Signed')

@section('breadcrumb')
    <li class="breadcrumb-item active">Survey Signed</li>
@endsection

@section('content')
    <section id="roles-listing">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Thank you</h4>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            @switch($event)
                                @case('signing_complete')
                                The document is Signed successfully.
                                @break
                                @case('cancel')
                                You can always follow the link emailed to you to finish Signing the contract.
                                @break
                                @case('decline')
                                Contract declined.
                            @endswitch
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <a href="{{route('admin.qas')}}" class="btn btn-primary">View All Surveys</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
