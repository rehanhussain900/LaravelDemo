
@if ($status == \App\Enums\ContractStatus::PENDING || $status == \App\Enums\ContractStatus::SENT)
    @can('edit contract')
        <a type="button"
                data-title="Edit Contract"
                href="{{route('admin.contract.edit',['contract'=>$id])}}"
                class="btn btn-icon btn-sm btn-primary waves-effect waves-float waves-light">
            <i data-feather='edit-2'></i>
        </a>
    @endcan
@endif

@can('access contracts')
    <button 
       data-title="Send Invoice"
       data-send="{{route('admin.contracts.send',$id)}}"
       class="btn btn-icon btn-sm btn-primary waves-effect waves-float waves-light">
        <i data-feather='send'></i>
    </button>
@endcan

@can('access contracts')
    <a href="{{route('admin.contracts.download',$id)}}"
       target="_blank"
       data-title="Download Contract"
       class="btn btn-icon btn-sm btn-success waves-effect waves-float waves-light">
        <i data-feather='download'></i>
    </a>
@endcan

@if ($status == \App\Enums\ContractStatus::SIGNED)
    @can('assign contracts')
        <a href="{{route('admin.contracts.assign',$id)}}"
        data-title="Assign Contract"
        class="btn btn-icon btn-sm btn-primary waves-effect waves-float waves-light">
            <i data-feather='user-plus'></i>
        </a>
    @endcan  
@endif


@can('delete contract')
    <button type="button"
            data-title="Hide Contract"
            data-delete="{{route('admin.contract.delete',$id)}}"
            class="btn btn-icon btn-sm btn-danger waves-effect waves-float waves-light">
        <i data-feather='trash'></i>
    </button>
@endcan