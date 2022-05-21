<div class="card" id="section-edit">
    <div class="card-header">
        <h4 class="card-title">Add Role</h4>
    </div>
    <div class="card-content collapse show">
        <div class="card-body">
            <form action="" method="POST" id="form-edit">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="label">Role Name<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="label" name="label" required autofocus>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-body" id="permissions-wrapper">@include('admin.roles.permissions')</div>
    </div>
    <div class="card-footer text-right">
        <button type="reset" class="btn btn-warning" form="form-edit" id="btnReset">Cancel</button>
        <button type="submit" class="btn btn-primary" form="form-edit">Save Role</button>
    </div>
</div>