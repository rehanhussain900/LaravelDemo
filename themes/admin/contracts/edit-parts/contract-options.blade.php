<div id="contract-options" class="content">
    <div class="content-header">
        <h5 class="mb-0">Contract Options</h5>
        <small class="text-muted">Select Contract Segments</small>
    </div>
    <form action="{{route('admin.contracts.store_segment')}}" method="post" id="formSegment">
        <div class="row">
            @foreach($options as $checkbox)
                <div class="col-md-6 col-12 mt-1">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input"
                               id="opt-{{$checkbox->id}}"
                               name="contract[]" value="{{$checkbox->id}}"
                                {{in_array($checkbox->id, $selected['segments'])?'checked':''}}>
                        <label class="custom-control-label"
                               for="opt-{{$checkbox->id}}">{{$checkbox->label}}</label>
                    </div>
                </div>
                @if($loop->even)
        </div>
        <div class="row">
            @endif
            @endforeach
        </div>
    </form>
    <div class="d-flex justify-content-between mt-2">
        <button class="btn btn-outline-secondary btn-prev" disabled>
            <i data-feather="arrow-left" class="align-middle mr-sm-25 mr-0"></i>
            <span class="align-middle d-sm-inline-block d-none">Previous</span>
        </button>
        <button class="btn btn-primary btn-next">
            <span class="align-middle d-sm-inline-block d-none">Next</span>
            <i data-feather="arrow-right" class="align-middle ml-sm-25 ml-0"></i>
        </button>
    </div>
</div>