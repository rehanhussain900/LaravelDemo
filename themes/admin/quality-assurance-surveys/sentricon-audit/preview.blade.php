@extends('admin.layouts.admin')
@section('title','Quality Assurance Surveys | '.$survey->type)
@section('heading','Quality Assurance Surveys | '.$survey->type)
@section('breadcrumb')
    <li class="breadcrumb-item active">Quality Assurance Surveys | {{$survey->type}}</li>
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
<section class="invoice-preview-wrapper">
    <div class="row invoice-preview">
        <!-- Invoice -->
        <div class="col-xl-10 col-md-10 col-12">
            <div class="card invoice-preview-card">
                <div class="card-body invoice-padding pb-0">
                    <!-- Header starts -->
                    <div class="d-flex justify-content-between flex-md-row flex-column invoice-spacing mt-0">
                        <div>
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
                        </div>
                        <div class="mt-md-0 mt-2">
                            <h4 class="invoice-title">
                                Survey ID
                                <span class="invoice-number">#{{$survey->id}}</span>
                            </h4>
                            <p class="card-text mb-25"><b>Technician: </b>{{$survey->technician->name}} </p>
                            <p class="card-text mb-25"><b>Inspection date: </b>{{$survey->survey_date}} </p>
                            <p class="card-text mb-0"><b>Auditor: </b>{{$survey->auditor->name}} </p>
                            <p class="card-text mb-0"><b>Audit Date: </b>{{$survey->audit_date}} </p>
                        </div>
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
                <!-- Invoice Description ends -->

                <hr class="invoice-spacing" />
                 <!-- Signature and score -->
                <div class="card-body invoice-padding pt-0">
                    <div class="row invoice-spacing">
                        <div class="col-md-4"> {{$survey->auditor_signature ?? 'N/A' }} <hr class="" /></div>
                        <div class="col-md-4">{{$survey->point_total ?? 'N/A'}} <hr class="" /></div>
                        <div class="col-md-4">{{$survey->is_follow_up == 1 ? 'Yes' : 'No'}} <hr class="" /></div>
                    </div>
                    <div class="row invoice-spacing">
                        <div class="col-md-4"><span class="font-weight-bold">Auditor Signature</span></div>
                        <div class="col-md-4"><span class="font-weight-bold">Point total</span></div>
                        <div class="col-md-4"><span class="font-weight-bold">Re-inspection required</span></div>
                    </div>
                </div>
                <!--  Signature and score  -->

                <hr class="invoice-spacing" />
                <!-- Invoice Note starts -->
                <div class="card-body invoice-padding pt-0">
                    <div class="row">
                        <div class="col-12">
                            <h4>A quality assurance pest control audit was conducted at your home today. </h4>
                        </div>
                    </div>
                </div>
                <!-- Invoice Note ends -->
                <!-- user questions starts -->
                <div class="card-body invoice-padding pt-0">
                    <div class="row">
                        <div class="col-8">
                            <div class="col-12">
                                <span class="font-weight-bold">During our inspection, we observed termite activity : </span>
                                <span>{{$survey->is_pest_activity == 1 ? 'Yes' : 'No'}}</span> 
                            </div>
                            <hr class="invoice-spacing" />
                            <div class="col-12">
                                <span class="font-weight-bold">We will have our office contact you to schedule a follow-up treatment.
                                    Conducive areas that may increase termite activity: </span> {{$survey->pest_activity_areas}}	
                            </div>
                            <hr class="invoice-spacing" />
                            <div class="col-12">
                                <span class="font-weight-bold">Quality inspection clear. Should you have questions or concerns, please contact our office at : </span> 
                                <span>5454664645654	</span>
                            </div>									
                        </div>
                        <div class="col-4">
                            <div class="logo-wrapper">
                                <span class="avatar">
                                    <img class="round" src="{{asset('themes/admin/images/logo/logo-icon.png')}}"
                                         alt="avatar" height="40" width="40">
                                </span>
                                <h3 class="text-primary invoice-logo">{{config('app.name')}}</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="invoice-spacing" />
                <!-- Invoice Note starts -->
                <div class="card-body invoice-padding pt-0">
                    <div class="row">
                        <div class="col-12">
                            <h4>We appreciate your business!</h4>
                        </div>
                        
                    </div>
                    <div class="row invoice-spacing">
                        <div class="col-md-3"><span class="font-weight-bold">Name : </span> {{$survey->name}}<hr class="invoice-spacing" /></div>
                        <div class="col-md-3"><span class="font-weight-bold">Title : </span> {{$survey->title}}<hr class="invoice-spacing" /></div>
                        <div class="col-md-3"><span class="font-weight-bold">Date : </span> {{$survey->survey_date}}<hr class="invoice-spacing" /></div>
                    </div>
                </div>
                <!-- user questions ends -->

            </div>
        </div>
        <!-- /Invoice -->

        <!-- Invoice Actions -->
        <div class="col-xl-2 col-md-2 col-12 invoice-actions mt-md-0 mt-2">
            <div class="card">
                <div class="card-body">
                    {{-- <button class="btn btn-primary btn-block mb-75" data-toggle="modal" data-target="#send-invoice-sidebar">
                        Send Invoice
                    </button>
                    <button class="btn btn-outline-secondary btn-block btn-download-invoice mb-75">Download</button> --}}
                    <a class="btn btn-outline-secondary btn-block mb-75" href="{{Route('admin.qas.export' , $survey->id)}}" target="_blank">
                        Print
                    </a>
                    {{-- <a class="btn btn-outline-secondary btn-block mb-75" href="./app-invoice-edit.html"> Edit </a>
                    <button class="btn btn-success btn-block" data-toggle="modal" data-target="#add-payment-sidebar">
                        Add Payment
                    </button> --}}
                </div>
            </div>
        </div>
        <!-- /Invoice Actions -->
    </div>
</section>
@endsection

@push('head')
    <style>

    </style>
@endpush

@push('footer')
    <script>
      
    </script>
@endpush