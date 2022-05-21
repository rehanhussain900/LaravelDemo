@can('edit misc deposits')
    <button type="button"
            data-title="Edit record"
            data-edit="{{route('admin.misc_deposits.edit',$id)}}"
            class="btn btn-icon btn-primary btn-sm waves-effect waves-float waves-light">
        <i data-feather='edit-2'></i>
    </button>
@endcan

@can('delete misc deposits')
    <button type="button"
            data-title="Delete record"
            data-delete="{{route('admin.misc_deposits.delete',$id)}}"
            class="btn btn-icon btn-danger btn-sm waves-effect waves-float waves-light">
        <i data-feather='trash'></i>
    </button>
@endcan