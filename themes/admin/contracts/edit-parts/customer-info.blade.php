<div id="customer-info" class="content">
    {{--<div class="content-header">
        <h5 class="mb-0">Customer Information</h5>
        <small>Enter Customer Information</small>
    </div>--}}
    <form action="{{route('admin.contracts.store_customer_info')}}" method="post" id="formCustomerInfo">
        <div class="row">
            <div class="form-group col-md-3">
                <label class="form-label" for="name">
                    Name<span class="text-danger">*</span>
                </label>
                <div class="form-check form-check-inline float-right">
                    <input class="form-check-input checkbox-lg" type="checkbox" id="chkNewCustomer" value="checked">
                    <label class="form-check-label" for="chkNewCustomer">New Customer.</label>
                </div>
                <input type="text" name="name" id="name" class="form-control"
                       placeholder="Name"
                       value="{{$contract->customer_name??''}}"
                       required/>
               
            </div>
            <div class="form-group col-md-3">
                <label class="form-label" for="business_name">
                    Business Name<small class="d-tablet-none">(if applicable)</small>
                </label>
                <input type="text" name="business_name" id="business_name" class="form-control"
                       placeholder="Business Name"
                       value="{{$contract->business_name??''}}"
                />
            </div>
            <div class="form-group col-md-6">
                <label class="form-label" for="billing_name">
                    Billing Name<span class="text-danger">*</span>
                </label>
                <input type="text" name="billing_name" id="billing_name" class="form-control"
                       placeholder="Billing Name"
                       value="{{$contract->billing_name??''}}"
                       required/>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                <label class="form-label" for="service_address">
                    Service Address<span class="text-danger">*</span>
                </label>
                <input type="text" name="service_address" id="service_address" class="form-control"
                       placeholder="Service Address"
                       value="{{$contract->service_address??''}}"
                       required/>
            </div>
            <div class="form-group col-md-6">
                <label class="form-label" for="billing_address">
                    Billing Address<small>(if different from service address)</small><span class="text-danger">*</span>
                </label>
                <input type="text" name="billing_address" id="billing_address" class="form-control"
                       placeholder="Billing Address"
                       value="{{$contract->billing_address??''}}"
                       required/>
                <div class="form-check form-check-inline">
                    <input class="form-check-input checkbox-lg" type="checkbox" id="chkSameAddress" value="checked">
                    <label class="form-check-label" for="chkSameAddress">Same as service address.</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-2">
                <label class="form-label" for="service_city">
                    City<span class="text-danger">*</span>
                </label>
                <input type="text" name="service_city" id="service_city" class="form-control"
                       placeholder="Service City"
                       value="{{$contract->service_city??''}}"
                       required/>
            </div>
            <div class="form-group col-md-2">
                <label class="form-label" for="service_state">
                    State<span class="text-danger">*</span>
                </label>
                <select name="service_state_id" id="service_state" class="form-control" required>
                    @if(!empty($contract->serviceState->name))
                        <option value="{{$contract->serviceState->id}}" selected>
                            {{$contract->serviceState->name}}
                        </option>
                    @endif
                </select>
            </div>
            <div class="form-group col-md-2">
                <label class="form-label" for="service_zip">
                    Zipcode<span class="text-danger">*</span>
                </label>
                <input type="text" name="service_zip" id="service_zip" class="form-control"
                       placeholder="Service Zipcode"
                       value="{{$contract->service_zip??''}}"
                       required/>
            </div>
            <div class="form-group col-md-2">
                <label class="form-label" for="billing_city">
                    City<span class="text-danger">*</span>
                </label>
                <input type="text" name="billing_city" id="billing_city" class="form-control"
                       placeholder="Business City"
                       value="{{$contract->billing_city??''}}"
                       required/>
            </div>
            <div class="form-group col-md-2">
                <label class="form-label" for="billing_state">
                    State<span class="text-danger">*</span>
                </label>
                <select name="billing_state_id" id="billing_state" class="form-control" required>
                    @if(!empty($contract->billingState->name))
                        <option selected
                                value="{{$contract->billingState->id}}">{{$contract->billingState->name}}</option>
                    @endif
                </select>
            </div>
            <div class="form-group col-md-2">
                <label class="form-label" for="billing_zip">
                    Zipcode<span class="text-danger">*</span>
                </label>
                <input type="text" name="billing_zip" id="billing_zip" class="form-control"
                       placeholder="Business Zipcode"
                       value="{{$contract->billing_zip??''}}"
                       required/>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                <label class="form-label" for="phone_home">
                    Phone #1<span class="text-danger">*</span>
                </label>
                <input type="text" name="phone_1" id="phone_home" class="form-control"
                       placeholder="Phone #1"
                       value="{{$contract->phone_1??''}}"
                       required/>
            </div>
            <div class="form-group col-md-6">
                <label class="form-label" for="phone_cell">
                    Phone #2<span class="text-danger">*</span>
                </label>
                <input type="text" name="phone_2" id="phone_cell" class="form-control"
                       placeholder="Phone #2"
                       value="{{$contract->phone_2??''}}"
                       required/>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                <label class="form-label" for="attention-line">
                    Attention Line<span class="text-danger">*</span>
                </label>
                <input type="text" name="attention_line" id="attention-line" class="form-control"
                       placeholder="Attention Line"
                       value="{{$contract->attention_line??''}}"
                       required/>
            </div>
            <div class="form-group col-md-6">
                <label class="form-label" for="email">
                    Email Address<span class="text-danger">*</span>
                </label>
                <input type="email" name="email" id="email" class="form-control"
                       placeholder="Email Address"
                       value="{{$contract->email??''}}"
                       required/>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-4 account-number-wrap" id="account-number-wrap">
                <label class="form-label" for="account-number">
                    Account Number
                </label>
                <input type="number" name="account_number" id="account-number" class="form-control"
                       placeholder="999999999"
                       value="{{$contract->account_number??''}}"/>
            </div>
            <div class="form-group col-md-4">
                <label class="form-label" for="proposed-by">
                    Proposed By<span class="text-danger">*</span>
                </label>
                <input type="text" name="proposed_by" id="proposed-by" class="form-control"
                       placeholder="John Doe"
                       value="{{$contract->proposed_by??\Auth::user()->email}}"
                       required/>
            </div>
            <div class="form-group col-md-4">
                <label class="form-label" for="contract-date">
                    Date<span class="text-danger">*</span>
                </label>
                <input type="text" name="contract_date" id="contract-date" class="form-control date-picker"
                       placeholder="{{\Carbon\Carbon::make('now')->format('m/d/Y')}}"
                       value="{{$contract->contract_date??\Carbon\Carbon::make('now')->format('Y-m-d')}}"
                       required/>
            </div>
        </div>
        <input type="hidden" value="{{$contract->id}}" name="id">
    </form>
    <div class="d-flex justify-content-between mt-2">
        <a class="btn btn-warning btn-prev" href="{{route('admin.contracts')}}">
            <i data-feather="arrow-left" class="align-middle mr-sm-25 mr-0"></i>
            <span class="align-middle d-sm-inline-block d-none">Cancel</span>
        </a>
        <button class="btn btn-primary btn-next">
            <span class="align-middle d-sm-inline-block d-none">Next</span>
            <i data-feather="arrow-right" class="align-middle ml-sm-25 ml-0"></i>
        </button>
    </div>
</div>
