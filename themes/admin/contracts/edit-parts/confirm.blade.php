{{--
<div class="collapse-default collapse-icon">
    <div class="card shadow-none">
        <div id="headingCollapse1" class="card-header" data-toggle="collapse" role="button"
             data-target="#collapse1" aria-expanded="false" aria-controls="collapse1">
            <span class="lead collapse-title"> Customer Information </span>
        </div>
        <div id="collapse1" role="tabpanel" aria-labelledby="headingCollapse1" class="collapse show" style="">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 col-12 col-cell">
                        <strong>Customer Name:</strong> {{$customer_info['name']}}
                    </div>
                    <div class="col-md-3 col-12 col-cell">
                        <strong>Billing Name:</strong> {{$customer_info['billing_name']}}
                    </div>
                    <div class="col-md-6 col-12 col-cell">
                        <strong>Service Address:</strong>
                        {{$customer_info['service_address']}}, {{$customer_info['service_city']}},
                        {{$customer_info['service_state_id']->name}} {{$customer_info['service_zip']}}
                    </div>
                    <div class="col-md-6 col-12 col-cell">
                        <strong>Billing Name:</strong> {{$customer_info['billing_name']}}
                    </div>
                    <div class="col-md-6 col-12 col-cell">
                        <strong>Billing Address:</strong>
                        {{$customer_info['billing_address']}}, {{$customer_info['billing_city']}},
                        {{$customer_info['billing_state_id']->name}} {{$customer_info['billing_zip']}}
                    </div>
                    <div class="col-md-6 col-12 col-cell">
                        <strong>Phone #1:</strong> {{$customer_info['phone_1']}}
                    </div>
                    <div class="col-md-6 col-12 col-cell">
                        <strong>Phone #2:</strong> {{$customer_info['phone_2']}}
                    </div>
                    <div class="col-md-6 col-12 col-cell">
                        <strong>Attention line:</strong> {{$customer_info['attention_line']}}
                    </div>
                    <div class="col-md-6 col-12 col-cell">
                        <strong>Email:</strong> {{$customer_info['email']}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 col-12">
                        <strong>Account Number:</strong> {{$customer_info['account_number']}}
                    </div>
                    <div class="col-md-4 col-12">
                        <strong>Proposed By:</strong> {{$customer_info['proposed_by']}}
                    </div>
                    <div class="col-md-4 col-12">
                        <strong>Date:</strong> {{\Carbon\Carbon::make($customer_info['contract_date'])->format('m/d/Y')}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card shadow-none">
        <div id="headingCollapse2" class="card-header collapse-header" data-toggle="collapse" role="button"
             data-target="#collapse2" aria-expanded="false" aria-controls="collapse2">
            <span class="lead collapse-title"> Species and Services </span>
        </div>
        <div id="collapse2" role="tabpanel" aria-labelledby="headingCollapse2" class="collapse show"
             aria-expanded="false"
             style="">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        @foreach($services as $specie)
                            <thead>
                            <tr>
                                <th colspan="7">{{$specie['name']}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td><strong>Service</strong></td>
                                <td><strong>Price/Visit</strong></td>
                                <td><strong>Tax</strong></td>
                                <td><strong>Discount</strong></td>
                                <td><strong>Total</strong></td>
                                <td><strong>Annual</strong></td>
                                <td><strong>Notes</strong></td>
                            </tr>
                            @foreach($specie['services'] as $service)
                                @if(empty($service['enabled']))
                                    @continue
                                @endif
                                <tr>
                                    <td>{{$service['service']->name??''}}</td>
                                    <td>${!! number_format($service['price'],2) !!}</td>
                                    <td>${!! number_format($service['tax'],2) !!}</td>
                                    <td>${!! number_format($service['discount'],2) !!}</td>
                                    <td>${!! number_format($service['total'],2) !!}</td>
                                    <td>${!! number_format($service['annual'],2) !!}</td>
                                    <td>{{$service['notes']}}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td><strong>Total First Year for this Program</strong></td>
                                <td colspan="6">{{number_format($specie['fyp'])}}</td>
                            </tr>
                            </tbody>
                        @endforeach
                        <tbody>
                        <tr>
                            <td colspan="5" class="text-right"><strong>Total First Year for All Program</strong></td>
                            <td colspan="2">${{number_format($customer_info['total_all_programs'])}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>--}}
<iframe src="{{route('admin.contracts.preview')}}"
        style="width: 100%;height: 80vh;border:none"></iframe>
