@extends('admin.layouts.admin')

@section('title','Generate Contract')
@section('heading','Generate Contract')

@section('breadcrumb')
    <li class="breadcrumb-item active">Contract Signed</li>
@endsection

@section('content')
    <section id="roles-listing">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Thank you</h4>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            @switch($event)
                                @case('signing_complete')
                                The document is Signed successfully.
                                @break
                                @case('cancel')
                                You can always follow the link emailed to you to finish Signing the contract.
                                @break
                                @case('decline')
                                Contract declined.
                            @endswitch
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <a href="{{route('admin.contracts')}}" class="btn btn-primary">View All Contracts</a>
                        <a href="{{route('admin.contracts.create')}}" class="btn btn-success">Start Over</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@include('components.ajax')
@push('footer')
    <script>
      $(document).ready(function () {
        $('#new-contract').on('submit', function (e) {
          e.preventDefault()
          let $el = $(this)
          AdminApp.blockCard($el)
          $.ajax({
            url: $el.attr('action'),
            type: 'post',
            dataType: 'json',
            success: function (res) {
              window.location.href = res.url
              console.log(res)
            },
            error: function (err) {
              AdminApp.ajaxError(err)
            },
            complete: function () {
              AdminApp.unblockCard($el)
            }
          })
        })
      })
    </script>
@endpush