@can('edit user')
    <button type="button"
            data-edit="{{route('admin.users.edit',$id)}}"
            data-title="Edit User"
            class="btn btn-sm btn-icon btn-primary waves-effect waves-float waves-light">
        <i data-feather='edit-2'></i>
    </button>
@endcan

@can('delete user')
    <button type="button"
            data-delete="{{route('admin.users.delete',$id)}}"
            data-title="Delete user"
            class="btn btn-sm btn-icon btn-danger waves-effect waves-float waves-light">
        <i data-feather='trash'></i>
    </button>
@endcan