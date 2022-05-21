@can('edit role')
    <button type="button"
            data-edit="{{route('admin.roles.edit',$id)}}"
            data-title="Edit Role and Permissions"
            class="btn btn-sm btn-icon btn-primary waves-effect waves-float waves-light">
        <i data-feather='edit-2'></i>
    </button>
@endcan

@can('delete role')
    <button type="button"
            data-delete="{{route('admin.roles.delete',$id)}}"
            data-title="Delete Role"
            class="btn btn-sm btn-icon btn-danger waves-effect waves-float waves-light">
        <i data-feather='trash'></i>
    </button>
@endcan