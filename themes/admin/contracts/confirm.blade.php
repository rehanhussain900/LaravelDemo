@extends('admin.layouts.admin')

@section('title','Generate Contract')
@section('heading','Generate Contract')

@section('breadcrumb')
    <li class="breadcrumb-item active">Generate Contract</li>
@endsection

@section('content')
    <section id="roles-listing">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">You have selected the following Options</h4>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <form action="{{route('admin.contracts.sign')}}" method="post" id="new-contract">
                                @csrf
                                <div id="accordionWrapa1" role="tablist" aria-multiselectable="true">
                                    <div class="collapse-default">
                                        @foreach($options as $option)
                                            <div class="card">
                                                <div id="h-{{Str::slug($option->label)}}" class="card-header collapsed"
                                                     data-toggle="collapse"
                                                     role="button" data-target="#s-{{Str::slug($option->label)}}"
                                                     aria-expanded="false"
                                                     aria-controls="s-{{Str::slug($option->label)}}">
                                                    <span class="lead collapse-title"> {{$option->label}} </span>
                                                </div>
                                                <div id="s-{{Str::slug($option->label)}}" role="tabpanel"
                                                     data-parent="#accordionWrapa1"
                                                     aria-labelledby="h-{{Str::slug($option->label)}}" class="collapse"
                                                     style="">
                                                    <div class="card-body">
                                                        <embed src="{{route('file.open',$option->segment)}}"
                                                               type="application/pdf" width="100%" style="height: 70vh">
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button type="submit" form="new-contract" class="btn btn-primary">Generate</button>
                        <a href="{{route('admin.contracts.create')}}" class="btn btn-success">Change Options</a>
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