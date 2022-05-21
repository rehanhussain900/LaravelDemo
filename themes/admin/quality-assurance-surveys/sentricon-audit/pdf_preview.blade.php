<html>
    <head>
        <!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <style>
       {!! file_get_contents(public_path('css/pdf/grid.css')) !!}
       {!! file_get_contents(public_path('css/pdf/table.css')) !!}

       td, th{
           font-size: 14px;
       }
       .avatar {
            background-color: #c3c3c3;
            border-radius: 50%;
            color: #fff;
            cursor: pointer;
            display: inline-flex;
            font-size: 1rem;
            font-weight: 600;
            position: relative;
            text-align: center;
            vertical-align: middle;
            white-space: nowrap;
        }
        .text-primary {
            color: #007AAD!important;
            position: relative;
            text-align: center;
            vertical-align: middle;
            white-space: nowrap;
        }
       
    </style>
    </head>
    <body>
        <section class="invoice-preview-wrapper container-fluid">
            <div class="row invoice-preview">
                <!-- Invoice -->
                <div class="col-12">
                    <div class="card invoice-preview-card">
                        <div class="card-body invoice-padding pb-0">
                            <!-- Header starts -->
                            <div class="d-flex justify-content-between flex-md-row flex-column invoice-spacing mt-0" style="width: 100%;">
                               
                                
                                <table>
                                    <tr>
                                        <td style="width:480px;"> <div>
                                            <div class="logo-wrapper">
                                                <span class="avatar">
                                                    <img class="round" src="{{asset('themes/admin/images/logo/logo-icon.png')}}"
                                                         alt="avatar" height="40" width="40">
                                                </span>
                                                <h3 class="text-primary invoice-logo">{{config('app.name')}}</h3>
                                            </div>
                                            <p class="card-text mb-25"><b>Branch: </b>{{$survey->branch->name}} </p>
                                            <p class="card-text mb-25"><b>Customer: </b>{{$survey->customer_name}} </p>
                                            <p class="card-text mb-0"><b>Address: </b>{{$survey->address}} </p>
                                            <p class="card-text mb-0"><b>Account #: </b>{{$survey->account_number}} </p>
                                        </div></td>
                                        <td><div class="mt-md-0 mt-2 ">
                                            <h4 class="invoice-title">
                                                Survey ID
                                                <span class="invoice-number">#{{$survey->id}}</span>
                                            </h4>
                                            <p class="card-text mb-25"><b>Technician: </b>{{$survey->technician->name}} </p>
                                            <p class="card-text mb-25"><b>Inspection Date: </b>{{$survey->treatement_date}} </p>
                                            <p class="card-text mb-0"><b>Auditor: </b>{{$survey->auditor->name}} </p>
                                            <p class="card-text mb-0"><b>Audit Date: </b>{{$survey->audit_date}} </p>
                                        </div></td>
                                    </tr>
                                </table>
                            </div>
                            <!-- Header ends -->
                        </div>
        
                        {{-- <hr class="invoice-spacing" /> --}}
        
                       
        
                        <!-- Invoice Description starts -->
                        <div class="table-responsive">
                            <table class="table">
                                @foreach ($survey->questionTitle as $title )
                                <thead>
                                    <tr>
                                        <th class="py-1">{{$title->title}}</th>
                                        <th class="py-1">Yes</th>
                                        <th class="py-1">No</th>
                                        <th class="py-1">N/A</th>
                                        <th class="py-1">Comments/Issues</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($title->questions as $question)
                                        @php
                                            $valid_ans = in_array($question->answer->selected_ans, explode(',',$question->valid_answer)) ? $question->answer->selected_ans : '' ; 
                                            
                                        @endphp
                                    <tr>
                                        <td class="py-1">
                                            <span class="font-weight-bold">{{$question->title}}</span>
                                        </td>
                                        @if (!empty($question->answer))
                                            <td class="py-1">
                                                <span class="font-weight-bold">{{$valid_ans == 'Yes'  ? $question->points.'pts' : ( $question->answer->selected_ans == 'Yes' ? 'Yes' : '' ) }}</span>
                                            </td>
                                            <td class="py-1">
                                                <span class="font-weight-bold">{{$valid_ans == 'No'  ? $question->points.'pts' : ( $question->answer->selected_ans == 'No' ? 'No' : '' )  }}</span>
                                            </td>
                                            <td class="py-1">
                                                <span class="font-weight-bold">{{$valid_ans == 'NA'  ? $question->points.'pts' : ( $question->answer->selected_ans == 'NA' ? 'NA' : '' )  }}</span>
                                            </td>  
        
                                        @else   
                                        <td class="py-1" colspan="3">
                                            <span class="font-weight-bold">No Selected Answer</span>
                                        </td>
                                        @endif
                                        <td class="py-1">
                                            <span class="font-weight-bold">{{$question->answer->comments}}</span>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                @endforeach
                                
                               
                            </table>
                        </div>
                        <div >
                            <table >
                                <tr>
                                    <td>{{$survey->auditor_signature ?? 'N/A' }}<hr class="" /></td>
                                    <td>{{$survey->point_total ?? 'N/A'}} <hr class="" /></td>
                                    <td>{{$survey->is_follow_up == 1 ? 'Yes' : 'No'}}<hr class="" /></td>
                                </tr>
                                <tr>
                                   <td>Auditor Signature</td>
                                   <td>Point total</td>
                                   <td>Re-inspection required</td>
                               </tr>
                            </table>
                            
                        </div>
                        <!--  Signature and score  -->
        
                        <hr />
                        <table>
                            <tr>
                                <td colspan="2"><b>A quality assurance pest control audit was conducted at your home today.</b><hr></td>
                                
                            </tr>
                            <tr>
                                <td></td>
                                <td rowspan="4" >
                                    <div class="logo-wrapper">
                                        <span class="avatar">
                                            <img class="round" src="{{asset('themes/admin/images/logo/logo-icon.png')}}"
                                                alt="avatar" height="40" width="40">
                                        </span>
                                        <h3 class="text-primary invoice-logo">{{config('app.name')}}</h3>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 500px;">
                                    <span class="font-weight-bold">During our inspection, we observed termite activity : </span>
                                    <span><u>{{$survey->is_pest_activity == 1 ? 'Yes' : 'No'}}</u></span> 
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 500px;">
                                    <hr>
                                    <span class="font-weight-bold">We will have our office contact you to schedule a follow-up treatment.
                                        Conducive areas that may increase termite activity : </span> <u>{{$survey->pest_activity_areas}}	</u>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 500px;">
                                    <hr>
                                    <span class="font-weight-bold">Quality inspection clear. Should you have questions or concerns, please contact our office at : </span> 
                                        <span>5454664645654	</span>
                                </td>
                            </tr>
                        </table>
                        <hr  />
                        <h4>We appreciate your business!</h4>
                        <hr  />
                        <table style="width: 100%">
                            <tr>
                                <td>Name : </span> {{$survey->name}}<hr/></td>
                                <td>Title : </span> {{$survey->title}}<hr/></td>
                                <td>Date : </span> {{$survey->survey_date}}<hr/></td>
                            </tr>
                        </table>
                        <!-- user questions ends -->
        
                    </div>
                </div>
                <!-- /Invoice -->
            </div>
        </section>
    </body>
</html>
