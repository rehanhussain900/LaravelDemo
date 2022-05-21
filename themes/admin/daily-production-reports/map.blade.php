@extends('admin.layouts.admin')
@section('title','Map')
@section('heading','Map')
@section('breadcrumb')
    <li class="breadcrumb-item active">Map</li>
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
    <section id="map-section">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            Map
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="map"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@include('components.ajax')

@push('head')
    <style>
        #map {
            width: 500px;
            height: 500px;
        }
    </style>
@endpush

@push('footer')
    <script
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAHLzRjbU8Be8OZTNGsIaPzWNE2dXP6W18&v=weekly"
    ></script>
    <script src="{{asset('plugins/gmap/gmaps.min.js')}}"></script>
    <script>
      let map = new GMaps({
        el: '#map',
        lat: -12.043333,
        lng: -77.028333
      })
    </script>
@endpush