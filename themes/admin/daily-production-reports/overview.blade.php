<div class="collapse-default">
    @foreach($technicians as $tech)
        <div class="card collapse-icon">
            <div id="heading-{{$tech->id}}" class="card-header {{!empty($expand)?'':'collapsed'}}" data-toggle="collapse"
                 role="button" data-target="#collapse-{{$tech->id}}" aria-expanded="false"
                 aria-controls="collapse-{{$tech->id}}">
                <span class="lead collapse-title"> {{ ucfirst( $tech->name ) }} </span>
            </div>
            <div id="collapse-{{$tech->id}}" role="tabpanel" class="collapse show " aria-labelledby="heading-{{$tech->id}}"
                 class="{{!empty($expand)?'show':'collapse'}}"
                 style="">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Customer</th>
                            <th>Service Details</th>
                            <th>Value</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                            @if($tech->DailyProductionReports)
                                @foreach ($tech->DailyProductionReports as $dpr)
                                    <tr >
                                        <td>
                                            <span class="fw-bold">{{$dpr->customer_name}} - {{$dpr->customer_number}} <br/>{{$dpr->address}}</span>
                                        </td>
                                        <td>{{$dpr->service_code}} <br/> Time In: {{$dpr->time_in}}  <br/>Time Out: {{$dpr->time_out}} <br/>Service Time: {{$dpr->service_time}} </td>
                                        <td>
                                            $ {{$dpr->value}}
                                        </td>
                                        <td>
                                              {{$dpr->created_at}}
                                        </td>
                                        <td>
                                            @if ($dpr->status == \App\Enums\DailyProductionReportStatus::APPROVED)
                                                <span class="badge rounded-pill badge-light-success me-1">{{$dpr->status}}</span>
                                            @else
                                                <span class="badge rounded-pill badge-light-primary me-1">{{$dpr->status}}</span>
                                            @endif
                                            
                                        </td>
                                        <td>
                                            @if ($dpr->status != \App\Enums\DailyProductionReportStatus::APPROVED)
                                                <button title="Approve Report" class="btn btn-icon btn-success btn-sm" onclick="approveReport({{$dpr->id}})"><i class="fa fa-check"></i></button>
                                            @endif
                                            {{-- <button title="View Details" class="btn btn-icon btn-info btn-sm" onclick="viewReport({{json_encode($dpr)}} , '{{ucfirst( $tech->name )}}')"><i class="fa fa-eye"></i></button> --}}
                                        </td>
                                    </tr>
                                @endforeach
                            @else 
                                <tr>
                                    <td colspan="6"> No Report Found for {{ucfirst( $tech->name )}}</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endforeach
</div>