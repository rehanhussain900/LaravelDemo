
<a  href="{{route('admin.qas.detail', $id)}}"
    data-title="View Survey"
    data-edit="{{$id}}"
    class="btn btn-icon btn-sm btn-primary waves-effect waves-float waves-light view-survey">
    <i data-feather='eye'></i>
</a>


{{-- @can('access contracts')
<a href="{{route('admin.contracts.download',$id)}}"
target="_blank"
data-title="Download Contract"
class="btn btn-icon btn-sm btn-success waves-effect waves-float waves-light">
<i data-feather='download'></i>
</a>
@endcan

@can('delete contract')
<button type="button"
    data-title="Delete Contract"
    data-delete="{{route('admin.contract.delete',$id)}}"
    class="btn btn-icon btn-sm btn-danger waves-effect waves-float waves-light">
<i data-feather='trash'></i>
</button>
@endcan --}}