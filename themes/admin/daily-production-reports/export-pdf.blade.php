<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{asset('css/pdf/table.css')}}">
    <style>
    </style>
</head>
<body>
<table class="table table-sm table-striped">
    @foreach($technicians as $tech)
        <tr class="thead-dark">
            <th colspan="6"> {{ucfirst( $tech->name )}} </th>
        </tr>
        <tr class="thead-light">
            <th>Customer</th>
            <th>Service Details</th>
            <th>Value</th>
            <th>Date</th>
            <th>Status</th>
        </tr>
       
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
                            <span class="badge rounded-pill badge-light-primary me-1">{{$dpr->status}}</span>
                        </td>
                        
                    </tr>
                @endforeach
            @else 
                <tr>
                    <td colspan="5"> No Report Found for {{ucfirst( $tech->name )}}</td>
                </tr>
            @endif
    @endforeach
</table>
</body>
</html>