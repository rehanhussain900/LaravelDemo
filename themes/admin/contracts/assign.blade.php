@extends('admin.layouts.admin')

@section('title','Assign Contract')
@section('heading','Assign Contract')

@section('breadcrumb')
    <li class="breadcrumb-item active">Assign Contract</li>
@endsection

@section('content')
    <section id="roles-listing">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Customer: {{$contract->customer_name}}</h4>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <form action="{{route('admin.contracts.assign' , $contract->id)}}" method="post" id="assign-contract">
                                @csrf
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="service_date">Service Date</label>
                                        <input name="service_date"
                                                  class="form-control date-picker" 
                                                  data-auto-expand
                                                  placeholder="{{\Carbon\Carbon::make('now')->format('m/d/Y')}}"
                                                  value="{{\Carbon\Carbon::make('now')->format('Y-m-d')}}"
                                                  type="date"
                                                  />
                                    </div>
                                    <div class="col-md-3">
                                        <label for="service_time">Time of Service</label>
                                        {{-- <input name="service_time"
                                                  class="form-control" 
                                                  data-auto-expand
                                                  placeholder="Time of service" 
                                                  value=""
                                                  type="time"
                                                  /> --}}
                                        <input type="text" 
                                               name="service_time"
                                               class="form-control time-mask" 
                                               placeholder="hh:mm" 
                                               id="time" />
                                    </div>
                                    <div class="col-md-3">
                                        <label for="technician">Technician</label>
                                        <select name="tech_id"
                                        class="form-control" 
                                        id="technician"
                                        placeholder="Technician" >
                                        @foreach ($technicians as $tech)
                                                <option value="{{$tech->id}}">{{$tech->name}}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="estimated_work_hours">Estimated Work Hours</label>
                                        <input name="estimated_work_hours"
                                                  class="form-control" 
                                                  data-auto-expand
                                                  placeholder="Estimated Work Hours" 
                                                  value=""
                                                  type="number"
                                                  />
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button type="submit" form="assign-contract" class="btn btn-primary">Assign</button>
                        <a href="{{route('admin.contracts')}}" class="btn btn-warning">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@include('components.ajax')
@include('components.date-picker')
@push('footer')
    <script src="{{asset('plugins/cleave/cleave.min.js')}}"></script>
    <script src="{{asset('themes/admin/js/form-input-mask.js')}}"></script>
    <script>
      $(document).ready(function () {
        $('#assign-contract').on('submit', function (e) {
          e.preventDefault()
          let $el = $(this)
          AdminApp.blockCard($el)
          $.ajax({
            url: $el.attr('action'),
            type: 'post',
            dataType: 'json',
            data : $el.serialize(),
            success: function (res) {
                AdminApp.success(res.message)
            },
            error: function (err) {
              AdminApp.ajaxError(err)
            },
            complete: function () {
              AdminApp.unblockCard($el)
            }
          })
        })

        $('#technician').select2({
          placeholder: 'Select Technician',
          allowClear: true,
        })
      })
    </script>
@endpush