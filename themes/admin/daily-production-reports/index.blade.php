@extends('admin.layouts.admin')
@section('title','Daily Production Reports')
@section('heading','Daily Production Reports')
@section('breadcrumb')
    <li class="breadcrumb-item active">Daily Production Reports</li>
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
    <section id="dpr">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <span class=" cursor-pointer" id="status-submitted" onclick="listSubmitted()">Submitted </span> | <span class="text-green cursor-pointer" id="status-approved"  onclick="listApproved()">Approved</span>
                        </div>
                    </div>
                   
                    <div class="card-body" id="filters-body">
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label class="form-label" for="service_state">
                                    Technician
                                </label>
                                <select name="tech_id" id="tech-id" class="form-control" required>
                                    <option value="-1">All</option>
                                    @foreach ($technicians as $tech)
                                        <option value="{{$tech->id}}">{{ ucfirst($tech->name)}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label class="form-label" for="service_state">
                                    Start Date
                                </label>
                                <input type="text" name="start_date" id="start-date" class="form-control date-picker"
                                        placeholder="Select Date"
                                        />
                            </div>
                            <div class="form-group col-md-3">
                                <label class="form-label" for="service_state">
                                    End Date
                                </label>
                                <input type="text" name="cend_date" id="end-date" class="form-control date-picker"
                                        placeholder="Select Date"
                                        />
                            </div>
                            <div class="form-group col-md-1">
                                <button class="btn btn-primary" id="generate-report" onclick="generateReport()" style="margin-top: 22px;">Search</button>
                            </div>
                            <div class="form-group col-md-1">
                                <button class="btn btn-primary" id="generate-report" onclick="generateReport(1)" style="margin-top: 22px;">Export</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                       
                    </div>
                   
                    <div class="card-body" id="report-body">
                        {{-- @include('admin.daily-production-reports.overview') --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@include('components.ajax')
@include('components.date-picker')
@push('head')
    <style>

    </style>
@endpush

@push('footer')
    <script>
        var statusFilter = '{{ \App\Enums\DailyProductionReportStatus::SUBMITTED }}';
      $(document).ready(function (e) {
        listSubmitted();
        // $('[data-report="1"]').on('click', function () {
        //   $('#the-modal').modal('show')
        // })
        // $('[data-dismiss="modal"]').on('click', function () {
        //   $('#the-modal').modal('hide')
        // })
      })

      function listSubmitted(){
        statusFilter = '{{ \App\Enums\DailyProductionReportStatus::SUBMITTED }}';
        generateReport();
        $('#status-submitted').addClass('text-success');
        $('#status-approved').removeClass('text-success');
      }

      function listApproved(){
        statusFilter = '{{ \App\Enums\DailyProductionReportStatus::APPROVED }}';
        generateReport();
        $('#status-approved').addClass('text-success');
        $('#status-submitted').removeClass('text-success');
      }

      function generateReport(isExport = 0){
            var tech_id = $('#tech-id').val();
            var start_date = $('#start-date').val();
            var end_date = $('#end-date').val();
            var el = $('#generate-report');
            AdminApp.blockCard(el);
            $.ajax({
                url: '{{ROUTE("admin.dpr.listing")}}',
                type: 'post',
                data: {tech_id: tech_id , start_date: start_date, end_date:end_date, export: isExport , status: statusFilter },
                success: function (res) {
                    if(res.status == 1){
                        AdminApp.success(res.message);
                        if(isExport == 0)
                            $('#report-body').html(res.data);
                        else
                            window.open('{{URL('/')}}/reports/'+res.data, '_blank');
                    }
                    else
                        AdminApp.ajaxError(res.message)
                },
                error: function (err) {
                    AdminApp.ajaxError(err)
                },
                complete: function () {
                    AdminApp.unblockCard(el)
                }
            });
      }

      function approveReport(id)
      {
            Swal.fire({
                title: 'Are you sure?',
                text: "Report will be uploaded to cloude system or pestpac!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, Approve it!',
                customClass: {
                    confirmButton: 'btn btn-primary',
                    cancelButton: 'btn btn-outline-danger ml-1'
                    },
                buttonsStyling: false
                }).then(function (result) 
                {
                    if (result.value) {
                        let el = $(this)
                        AdminApp.blockCard(el)
                        $.ajax({
                            url: '{{ROUTE("admin.dpr.approve")}}',
                            type: 'post',
                            data: {id: id},
                            success: function (res) {
                                if(res.status == 1){
                                    AdminApp.success(res.message);
                                    generateReport();
                                }
                                else
                                    AdminApp.ajaxError(res.message)
                            },
                            error: function (err) {
                                AdminApp.ajaxError(err)
                            },
                            complete: function () {
                                AdminApp.unblockCard(el)
                            }
                        });
                    }
                });
      }

      function viewReport(reportData , tech_name){
        console.log(reportData);
        console.log(tech_name);
        //$('#details-modal').modal('show')
      }
    </script>
@endpush