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
        <img src="{!! \App\Helpers\Files::imageToBase64('css/pdf/pdf-1.jpg') !!}" alt="Logo"
             style="width: 123px;height: 64px">
    </div>
    <div class="col-6-sm text-center">
        <div class="bold size-18px">Service Agreement</div>
        <div class="size-8px">Corporate Office: 155 Woolco Drive, Marietta, GA 30062</div>
        <div class="size-8px bold">
            Remit Payments to:<br/>
            Critter Control Operations, Inc., PO Box 6849, Marietta, GA 30065
        </div>
        <div class="size-8px">Toll Free: 800-334-0653 Fax: 770-977-1616 www.crittercontrol.com</div>
    </div>
    <div class="col-3-sm">
        <div class="size-8px my-1">Account #: {{$customer_info['account_number']}}</div>
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
        <div class="size-10px">Business Name:</div>
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
                <td class="size-10px">Phone:</td>
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
        <div class="size-10px">Business Name:</div>
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
                <td class="size-10px">Phone:</td>
                <td class="size-10px">
                    {{$customer_info['phone_2']}}
                </td>
            </tr>
            <tr>
                <td class="size-10px">E-mail:</td>
                <td class="size-10px">
                    {{$customer_info['attention_line']}}
                </td>
            </tr>
        </table>
    </div>
</div>
<hr>
<div class="size-10px text-center bold">Description of Services</div>
<div class="bold size-13px">
    Bats on front patio as well as behind header on back patio. Several unscreened roof vents and dozens of feet of
    caulking necessary on top of also addressing the vulnerable birdblock fascia board screens.
</div>
<div class="size-7px" style="margin-top:6px">
    <p>
        Bats are extremely beneficial animals in our environment, however present potential hazards (disease, rabies,
        etc.)
        when they are in structures and around people. Common home invaders include the Little Brown Bat, Big Brown Bat,
        Mexican/Brazilian Free-tailed Bat, Hoary Bat, Myotis Bats, Pipistrelle Bat, and Indiana Bat. Aside from carrying
        rabies and other diseases, bats can harbor ectoparasites like Bat Bugs and Guano Beetles.

    </p>
    <p>
        Once establishing a roosting area bats will persistently attempt to re-enter the structure to remain at the
        same site. Bats can enter openings as small as 1/4 of an inch. Guano can build up in infestation areas and cause
        odors, damage to the area due to its acidic properties, and house fungal disease agents, such as Histoplasmosis.
    </p>
    <p>
        When solving a bat infestation, a complete seal up (full exclusion) of the structure is required. A proactive
        approach to sealing up all potential entry points will help to prevent reoccurrence of the infestation. Bats are
        federally protected species and cannot be exterminated.
    </p>
    <p>
        The sealing process may include the use of one-way devices to allow the bats to leave the structure and not
        re-enter. If bats have been established on the structure for any amount of time the removal of guano and
        sanitization of contaminated areas is also strongly recommended.
    </p>
</div>
<table class="table-simple">
    <tr>
        <th class="bold size-10px" style="width: 40%">Exclusion Repairs with Warranty Program</th>
        <th class="bold size-10px">Price/Visit</th>
        <th class="bold size-10px">Tax</th>
        <th class="bold size-10px">Discount</th>
        <th class="bold size-10px">Total</th>
        <th class="bold size-10px">Annual</th>
    </tr>
    <tr class="size-10px">
        <td>Full Exclusion Repairs (Bats)</td>
        <td>${{number_format(random_int(10000,99999),2)}}</td>
        <td>${{number_format(random_int(100,9999),2)}}</td>
        <td>${{number_format(random_int(100,9999),2)}}</td>
        <td>${{number_format(random_int(100,9999),2)}}</td>
        <td>${{number_format(random_int(100,9999),2)}}</td>
    </tr>
    <tr class="size-8px">
        <td class="indent">
            NETTING INSTALLATION<br/><br>
            Install heavy duty 3/8” woven polyethylene netting as a horizontal plane on the underside of the front patio
            (40 sq. ft.) as well as the back patio (280 sq. ft.) to employ a physical barrier for bats accessing these
            areas in the future. 10-year manufacturer’s warranty and 1 year labor warranty. This price would include all
            of the same processes described below in the excluder valve section, $12/square foot x 320 sq. ft. =
            $3,840.00.
        </td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr class="size-10px">
        <td>Full Exclusion Repairs (Bats)</td>
        <td>${{number_format(random_int(10000,99999),2)}}</td>
        <td>${{number_format(random_int(100,9999),2)}}</td>
        <td>${{number_format(random_int(100,9999),2)}}</td>
        <td>${{number_format(random_int(100,9999),2)}}</td>
        <td>${{number_format(random_int(100,9999),2)}}</td>
    </tr>
    <tr class="size-8px">
        <td class="indent">
            NETTING INSTALLATION<br/><br>
            Install heavy duty 3/8” woven polyethylene netting as a horizontal plane on the underside of the front patio
            (40 sq. ft.) as well as the back patio (280 sq. ft.) to employ a physical barrier for bats accessing these
            areas in the future. 10-year manufacturer’s warranty and 1 year labor warranty. This price would include all
            of the same processes described below in the excluder valve section, $12/square foot x 320 sq. ft. =
            $3,840.00.
        </td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr class="size-10px">
        <td>Full Exclusion Repairs (Bats)</td>
        <td>${{number_format(random_int(10000,99999),2)}}</td>
        <td>${{number_format(random_int(100,9999),2)}}</td>
        <td>${{number_format(random_int(100,9999),2)}}</td>
        <td>${{number_format(random_int(100,9999),2)}}</td>
        <td>${{number_format(random_int(100,9999),2)}}</td>
    </tr>
    <tr class="size-8px">
        <td class="indent">
            NETTING INSTALLATION<br/><br>
            Install heavy duty 3/8” woven polyethylene netting as a horizontal plane on the underside of the front patio
            (40 sq. ft.) as well as the back patio (280 sq. ft.) to employ a physical barrier for bats accessing these
            areas in the future. 10-year manufacturer’s warranty and 1 year labor warranty. This price would include all
            of the same processes described below in the excluder valve section, $12/square foot x 320 sq. ft. =
            $3,840.00.
        </td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr class="size-10px">
        <td>Full Exclusion Repairs (Bats)</td>
        <td>${{number_format(random_int(10000,99999),2)}}</td>
        <td>${{number_format(random_int(100,9999),2)}}</td>
        <td>${{number_format(random_int(100,9999),2)}}</td>
        <td>${{number_format(random_int(100,9999),2)}}</td>
        <td>${{number_format(random_int(100,9999),2)}}</td>
    </tr>
    <tr class="size-8px">
        <td class="indent">
            NETTING INSTALLATION<br/><br>
            Install heavy duty 3/8” woven polyethylene netting as a horizontal plane on the underside of the front patio
            (40 sq. ft.) as well as the back patio (280 sq. ft.) to employ a physical barrier for bats accessing these
            areas in the future. 10-year manufacturer’s warranty and 1 year labor warranty. This price would include all
            of the same processes described below in the excluder valve section, $12/square foot x 320 sq. ft. =
            $3,840.00.
        </td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td colspan="3" class="bold size-10px">

        </td>
    </tr>
</table>
<div class="row">
    <div class="col-7-sm">

    </div>
    <div class="col-5-sm bold size-10px">
        TOTAL FIRST YEAR FOR THIS PROGRAM $4,800.00<br/>
        TOTAL FIRST YEAR FOR ALL PROGRAMS $4,800.00
    </div>
</div>
<div class="bold size-13px">
    50% deposit required to schedule with the remainder due upon completion. 90 days same as cash deferred billing
    available for customers on approved credit.
</div>
<br>
<div class="size-8px">
    <p>
        Most areas have a period where bats may not be disturbed due to the risk of killing young bats. Depending on
        local regulations bat exclusions may be able to be started but not completed until after this "blackout" period
        ends.
    </p>
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
        cmorris@rollins.com<br/>
        192.168.50.14<br/>
        8/12/2021<br/>
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