<div class="card" id="section-edit">
    <div class="card-header">
        <h4 class="card-title">Add User</h4>
    </div>
    <div class="card-content collapse show">
        <div class="card-body">
            <form action="" method="POST" id="form-edit">
                <div class="row">
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="name">
                                User Name<span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" id="name" name="name" required autofocus>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="email">Email<span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="password">Password<span class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="password_confirmation">Confirm Password</label>
                            <input type="password" class="form-control" id="password_confirmation"
                                   name="password_confirmation">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="roles">Roles<span class="text-danger">*</span></label>
                            <select name="roles[]" id="roles" class="form-control" multiple required>
                                @foreach($roles as $role)
                                    <option value="{{$role->id}}">{{$role->label}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="branches">Branches<span class="text-danger">*</span></label>
                            <select name="branches[]" id="branches" class="form-control" multiple required>
                                @foreach($branches as $branch)
                                    <option value="{{$branch->id}}">{{$branch->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" class="form-control"></textarea>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card-footer text-right">
        <button type="reset" class="btn btn-warning" form="form-edit" id="btnReset">Cancel</button>
        <button type="submit" class="btn btn-primary" form="form-edit">Save User</button>
    </div>
</div>