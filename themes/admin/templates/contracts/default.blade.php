@php($include_bat = false)
        <!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <style>
        {!! file_get_contents(public_path('css/pdf/grid.css')) !!}
        body {
            font-family: Tahoma, sans-serif;
        }

        .table-simple {
            border-collapse: collapse;
            border: none;
            width: 100%;
        }

        .table-simple th {
            text-align: left;
        }

        .text-center {
            text-align: center;
        }

        .size-4px {
            font-size: 4px !important;
        }

        .size-7px {
            font-size: 7px !important;
        }

        .size-8px {
            font-size: 8px !important;
        }

        .size-9px {
            font-size: 9px !important;
        }

        .size-10px {
            font-size: 10px !important;
        }

        .size-18px {
            font-size: 18px !important;
        }

        .size-13px {
            font-size: 13px !important;
        }

        .bold {
            font-weight: bold !important;
        }

        .hr {
            height: 1px;
            margin-bottom: 0;
            margin-top: 3px;
            color: black;
        }

        .indent {
            padding-left: 5px;
        }
    </style>
    <title></title>
</head>
<body>
<div class="row">
    <div class="col-3-sm">
        <img src="{!! \App\Helpers\Files::imageToBase64('themes/admin/images/logo/logo-pd.png') !!}" alt="Logo"
             style="width: 123px;height: 64px">
    </div>
    <div class="col-6-sm text-center">
        <div class="bold size-18px">Service Agreement</div>
        <div class="size-8px">Local Branch: 3611 S. Broadmont Dr, Suite 101, Tucson, AZ 85713</div>
        <div class="size-8px bold">
            Remit Payments to:<br/>
            HomeTeam PestDefense 3611 S. Broadmont Dr, Suite 101, Tucson, AZ 85713
        </div>
        <div class="size-8px">Toll Free: 800-334-0653 Fax: 770-977-1616 www.crittercontrol.com</div>
    </div>
    <div class="col-3-sm">
        <div class="size-8px my-1">Account #: {{@$customer_info['account_number']}}</div>
        <div class="size-8px my-1">
            Date:&nbsp;&nbsp;&nbsp;&nbsp;{{\Carbon\Carbon::make($customer_info['contract_date'])->format('m/d/Y')}}</div>
        <div class="size-8px bold my-1">Proposed By:</div>
        <div class="size-8px">{{$customer_info['proposed_by']}}</div>
    </div>
</div>
<hr style="margin:0;padding:0">
<div class="row">
    <div class="col-6-sm">
        <div class="bold size-10px">BILLING INFORMATION</div>
        {{--<div class="size-10px">Business Name:</div>--}}
        <table class="table-simple">
            <tr>
                <td class="size-10px">Name:</td>
                <td class="size-10px">
                    {{$customer_info['business_name']}}
                </td>
            </tr>
            <tr>
                <td class="size-10px">Address:<br><br/></td>
                <td class="size-10px">
                    {{$customer_info['billing_address']}}
                    {{$customer_info['billing_city']}}, {{$customer_info['billing_state_id']->name}}
                    {{$customer_info['billing_zip']}}
                    <br><br/>
                </td>
            </tr>
            <tr>
                <td class="size-10px">Phone #1:</td>
                <td class="size-10px">
                    {{$customer_info['phone_1']}}
                </td>
            </tr>
            <tr>
                <td class="size-10px">E-mail:</td>
                <td class="size-10px">
                    {{$customer_info['email']}}
                </td>
            </tr>
        </table>
    </div>
    <div class="col-6-sm">
        <div class="bold size-10px">SERVICE INFORMATION</div>
        {{--<div class="size-10px">Business Name:</div>--}}
        <table class="table-simple">
            <tr>
                <td class="size-10px">Name:</td>
                <td class="size-10px">
                    {{$customer_info['name']}}
                </td>
            </tr>
            <tr>
                <td class="size-10px">Address:<br><br/></td>
                <td class="size-10px">
                    {{$customer_info['service_address']}}
                    {{$customer_info['service_city']}}, {{$customer_info['service_state_id']->name}}
                    {{$customer_info['service_zip']}}
                    <br><br/>
                </td>
            </tr>
            <tr>
                <td class="size-10px">Phone #2:</td>
                <td class="size-10px">
                    {{$customer_info['phone_2']}}
                </td>
            </tr>
            <tr>
                <td class="size-10px">Attention Line:</td>
                <td class="size-10px">
                    {{$customer_info['attention_line']}}
                </td>
            </tr>
        </table>
    </div>
</div>
<hr>
@foreach($services as $specie)
    @if(\Illuminate\Support\Str::contains($specie['name'],'Bat'))
        @php($include_bat = true)
    @endif
    <div class="size-10px text-center bold">{{$specie['name']}}</div>
    <div class="size-7px" style="margin-top:6px">
        {!! $specie['description'] !!}
    </div>
    <?php
        $discount = 0;

        foreach($specie['services'] as $service){
            if(!empty($service['enabled'])) {
                $discount += $service['discount'];
            }
                        }
      ?>
    <table class="table-simple">
        <tr>
            <th class="bold size-10px" style="width: 40%"></th>
            <th class="bold size-10px">Price/Visit</th>
            <th class="bold size-10px">Tax</th>
            @if ($discount > 0)
                <th class="bold size-10px">Discount</th>
            @endif
            
            <th class="bold size-10px">Total</th>
            <th class="bold size-10px">Annual</th>
        </tr>
        @foreach($specie['services'] as $service)
            @if(empty($service['enabled']))
                @continue
            @endif
            <tr class="size-10px">
                <td class="bold size-10px<?php echo( !empty( $service[ 'service' ]->parent ) ? ' indent' : '' ) ?>">
                    {{$service['service']->name}}
                </td>
                <td>${{number_format($service['price'],2)}}</td>
                <td>${{number_format($service['tax'],2)}}</td>
                @if ($discount > 0)
                    <td> {{  '$'.number_format($service['discount'],2) }}</td>
                @endif
                <td>${{number_format($service['total'],2)}}</td>
                <td>${{number_format($service['annual'],2)}}</td>
            </tr>    
            <tr class="size-8px">
                <td class="<?php echo( !empty( $service[ 'service' ]->parent ) ? ' indent' : '' ) ?>">
                    {!! nl2br($service['notes']) !!}
                </td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr class="size-10px">
                <td class="size-10px<?php echo( !empty( $service[ 'service' ]->parent ) ? ' indent' : '' ) ?>">
                    {{-- <b>Date of Service : </b>{{$service['service_date']}}<br/>
                    <b>Time of service : </b>{{$service['service_time']}}<br/>
                    <b>Technician : </b>{{$service['technician']}} <br/>
                    <b>Estimated Work Hours : </b>{{$service['estimated_work_hours']}} --}}
                </td>
                <td colspan="5"></td>
            </tr>    
            <tr>
                <td colspan="6" class="size-8px">&nbsp;</td>
            </tr>
            
        @endforeach
    </table>
    
    <div class="row">
        <div class="col-7-sm">&nbsp;</div>
        <div class="col-5-sm bold size-10px">
            TOTAL FIRST YEAR FOR THIS PROGRAM $<?php echo number_format( $specie[ 'fyp' ] ) ?><br/>
        </div>
    </div>
    <div class="">&nbsp;</div>
@endforeach
<div class="row">
    <div class="col-7-sm"></div>
    <div class="col-5-sm bold size-10px">
        TOTAL FIRST YEAR FOR THIS PROGRAM $<?php echo number_format( $customer_info[ 'total_all_programs' ] ) ?><br/>
    </div>
</div>
<div class="">&nbsp;</div>
<div class="bold size-13px">
    A 50% deposit is required to schedule, with the remainder due upon completion. 90 days same as cash deferred billing
    available for customers on approved credit.
</div>
<br>
<div class="size-8px">
    @if($include_bat)
        <p>
            Most areas have a period where bats may not be disturbed due to the risk of killing young bats. Depending on
            local regulations bat exclusions may be able to be started but not completed until after this "blackout"
            period
            ends.
        </p>
    @endif
    <p>
        We are a vertically integrated company. From start to finish, each of our team members are trained 100%
        in-house, for their job task. We take tremendous pride in this fact, and it gives you our customer, the very
        best possible outcome. Some companies might claim to do it right; we have the reviews and reputation to prove
        it!
    </p>
    <p>
        CRITTER CONTROL CONDITIONALLY GUARANTEES THAT THE ABOVE LISTED STRUCTURE WILL BE FREE OF TARGETED ANIMAL FROM
        THE AREAS REPAIRED FOR THE AGREED UPON WARRANTY DURATIONS FROM DATE THAT THE WORK HAS BEEN COMPLETED. THE
        GUARANTEE APPLIES ONLY TO THE ANIMAL(S) DESIGNATED ON THIS CONTRACT. IF RE-ENTRY OCCURS DURING THE WARRANTY
        DURATION THROUGH THE AREAS REPAIRED, THE ANIMAL (S) WILL BE REMOVED AND NECESSARY EXCLUSION REPAIRS MADE AT NO
        CHARGE. CRITTER CONTROL WILL NOT BE RESPONSIBLE FOR ANY DAMAGE TO THE BUILDING OR ITS CONTENTS CAUSED BY THE
        ENTRY OF ANY ANIMAL INTO THE STRUCTURE. THIS WARRANTY MAY BE EXTENDED PAST THE ORIGINAL DURATION SUBJECT TO
        CRITTER CONTROL APPROVAL AND POSSIBLE ANNUAL RATE ADJUSTMENT. INSPECTION WILL BE MADE ONLY UPON CUSTOMER
        REQUEST. EXCLUSION REPAIRS TO AREAS DESCRIBED ABOVE CORRESPOND WITH THE DESCRIPTION NOTED ON THIS AGREEMENT AND
        ON THE INCLUDED GRAPH. WARRANTY WILL BECOME VOID SHOULD WORK COMPLETED BY REMOVED BY THIRD PARTY OR AN ACT OF
        GOD.
    </p>
    <p class="bold">
        FINANCE CHARGE will be assessed of 1.5% on invoices 31 days past due; equal to 18% APR. A $35.00 fee will be
        assessed on all returned c
    </p>
    <p class="bold">
        CANCELLATION: CUSTOMER MAY CANCEL THIS AGREEMENT AT ANY TIME PRIOR TO MIDNIGHT OF THE THIRD BUSINESS DATE AFTER
        THE DATE OF THIS TRANSACTION.
    </p>
    <p class="bold">
        I have read and understand the terms of the Agreement including the Exclusion and Limitations on the back page.
    </p>
</div>
<div class="row" style="position: relative">
    <div style="width:25%">
        <br>
        <br>
        <br>
        <hr>
        <div class="size-8px">Customer Signature</div>
    </div>
    <div class=" size-8px" style="position: absolute;left:35%;top:10px">
        {{Auth::user()->email}}<br/>
        {{\Request::ip();}}<br/>
        {{\Carbon\Carbon::make($customer_info['contract_date'])->format('m/d/Y')}}<br/>
    </div>
</div>
<div class="row">
    <div class="col-12-sm size-10px bold text-center">TERMS AND CONDITIONS</div>
</div>
<div class="size-9px">
    <p>
        These Terms and Conditions apply to all Services performed by Trutech LLC and Critter Control Operations Inc.,
        herein referred to as "the Company" unless specifically identified.
    </p>
    <p>
        Contact Information :<br/>
        Trutech LLC - Phone: 800.842.7296 / Critter Control Operations, Inc - Phone: 800.334.0653
    </p>
    <p>
        CUSTOMER OBLIGATIONS: Customer understands that results of service are relative to and dependent upon the
        cooperation of the Customer as to housekeeping, appropriate sanitation, maintenance, accessibility of areas to
        be serviced, and reasonably necessary structural repairs and corrective measures. Customer agrees to extend all
        reasonably necessary cooperation to facilitate treatment and pest control.
    </p>
    <p>
        RELEASE AND LIMITATION OF LIABILITY: (a) Customer expressly releases Company from liability for any claim
        whatsoever including, but not limited to, personal injury (including stings or bites from fire ants, spiders, or
        any other pests) or property damage (to include the structure and its contents), unless caused by the gross
        negligence or willful misconduct of Company. Customer agrees that under no circumstances shall Company be liable
        for any amount greater than the amount paid by the Customer to Company for the services provided at the affected
        location(s). (b) IN NO EVENT SHALL EITHER PARTY BE LIABLE TO THE OTHER PARTY OR ANY OTHER PERSON FOR ANY
        INDIRECT, INCIDENTAL, PUNITIVE, SPECIAL OR CONSEQUENTIAL DAMAGES RELATED TO THIS AGREEMENT OR THE SERVICES
        PERFORMED HEREUNDER INCLUDING, BUT NOT LIMITED TO, LOSS OF USE OR ANTICIPATED PROFITS, PRODUCTION DELAYS,
        BUSINESS INTERRUPTION, OR LOSS OF REPUTATION OR GOODWILL.
    </p>
    DISPUTE RESOLUTION:<br/>
    (a) Arbitration . Any controversy or claim arising out of or relating to this Agreement or any other agreement
    between the parties, including but not limited to any contractual, tort and statutory claims, and any alleged claims
    for personal injury or property damage, shall be settled by binding arbitration. Unless the parties agree otherwise,
    the arbitration shall be held in the city of the corporate headquarters of the Party against whom arbitration is
    sought and administered under the Commercial Arbitration Rules of the American Arbitration Association ("AAA"). The
    parties expressly agree that the arbitrator shall follow (i) the substantive law of the state where the cause of
    action arose; and (ii) the terms and conditions of this Agreement. Either Party has the right to require a panel of
    three (3) arbitrators, and the requesting Party shall be responsible for the cost of the additional arbitrators.
    Either Party may request at any time prior to the hearing that the award be accompanied by a reasoned opinion. The
    award rendered by the arbitrator(s) shall be final and binding on all parties. The Parties acknowledge and agree
    that this arbitration provision is made pursuant to a transaction involving interstate commerce and shall be
    governed by the Federal Arbitration Act.
    <br/>(b) Class Action Waiver . Any legal proceeding of any nature must be brought in the Party’s individual
    capacity, and not as a plaintiff or class member in any purported class action, collective action, private attorney
    general action, or a multiple plaintiff or similar representative proceeding.
</div>
<div class="size-9px">
    <br/>
    MISCELLANEOUS:
    <p>
        (i) Entire Agreement . This Agreement constitutes the entire agreement between Customer and Company with respect
        to the Services and supersedes all prior negotiations, representations or agreements relating thereto either
        written or oral, except to the extent that they are expressly incorporated herein. Unless otherwise expressly
        provided herein, no changes, alterations or modifications to this Agreement shall be effective unless in writing
        and signed by the respective parties hereto. If any term or provision, or portion thereof, is deemed to be
        invalid or unenforceable under applicable law, this Agreement shall be considered divisible as to each such term
        or provision, and such unenforceable term or provision shall not affect any other term or provision of this
        Agreement, and the remaining terms and provisions of this Agreement shall remain binding and be construed and
        enforced accordingly. This Agreement is the product of negotiations between the Parties and shall be construed
        without regard to any presumption or rule requiring adverse construction or interpretation against either party.
    </p>
    <p>
        (ii) Force Majeure . Company will be relieved of its obligations and may terminate this Agreement upon providing
        sixty (60) days’ written notice if any of the obligations set forth in this Agreement are not met by the
        Customer, or in the event of a change in state or federal law that materially affects Company’s obligations
        under this Agreement. Moreover, Company may terminate if it cannot perform its responsibilities due to (a) acts
        of God; (b) flood, fire, earthquake, or explosion; (c) war, invasion, hostilities (whether war is declared or
        not), terrorist threats or acts, riot, or other civil unrest; (d) government order or law; (e) actions,
        embargoes, or blockades in effect on or after the date of this Agreement; (f) action by any governmental
        authority; (g) national or regional emergency; (h) strikes, labor stoppages or slowdowns, or other industrial
        disturbances; (i) pandemic; (j) unavailability of pesticides or other supplies from ordinary sources; or (k)
        shortage of adequate power or transportation facilities.
    </p>
    <p>
        CHEMICAL INFORMATION WARNING: Virtually all pesticides have some odor which may be present for a period on time
        after application. If you or any member of your household believes you have sensitivity to chemical odor or
        chemicals, the Company recommends that you not have an initial or a subsequent service performed at your
        premises until you have consulted with your family physician. At your request, the Company will provide
        information about the chemicals to be used in treating the premises.
    </p>
    State-Specific Licensing Information :<br/>
    AZ: Arizona Business License #9062.<br/>
    CO: Commercial applicators are licensed by the Colorado Department of Agriculture.<br/>
    GA: The Georgia Structural Pest Control Act requires all pest control companies to maintain insurance coverage.
    Information about this coverage is available from this pest control company<br/>
    NC: North Carolina License # 2014P<br/>
    TN: Trutech Tennessee Charter # 4259. Critter Control Operations Charter # 5117<br/>
    Trutech LLC : Business License #: 13625, 624018, 62420 Licensed and regulated by: Texas Department of Agriculture,
    P.O. Box 12847,
    Austin, TX 78711-2847. Phone (866) 916-4481, Fax (888) 232-2567. Customer information sheet available on website.
    www.trutechinc.com
    <p>
        Critter Control Operations Inc .: Business License #: 742414, 775291 Licensed and regulated by: Texas Department
        of Agriculture, P.O. Box 12847, Austin, TX 78711-2847. Phone (866) 916-4481, Fax (888) 232-2567. Customer
        information sheet available on website.
        <br/>www.crittercontrol.com
    </p>
</div>
</body>
</html>
