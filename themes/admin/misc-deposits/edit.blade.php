<div class="card" id="section-edit">
    <div class="card-header">
        <h4 class="card-title">Add Misc Deposit</h4>
    </div>
    <div class="card-content collapse show">
        <div class="card-body" id="editor-view">
            <form action="" method="POST" id="form-edit">
                <input type="hidden" name="confirmed" id="confirmed">
                <div class="row">
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="branch">Branch<span class="text-danger">*</span></label>
                            <select name="branch_id" id="branch" class="form-control" required autofocus>
                                <option value="">Select Branch</option>
                                @foreach($branches as $branch)
                                    <option value="{{$branch['branch_id']}}">{{$branch['name']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="gl_account_number">GL Account Number<span class="text-danger">*</span></label>
                            <select name="gl_account_number" id="gl_account_number" class="form-control" required>
                                <option value="">Select GL Account Number</option>
                                @foreach($gl_accounts as $account)
                                    <option value="{{$account->number}}">{{$account->label}} ({{$account->number}})</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="deposit-date">Deposit Date<span class="text-danger">*</span></label>
                            <input type="text" class="form-control date-picker" id="deposit-date" name="deposit_at"
                                   required>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="amount">Amount<span class="text-danger">*</span>
                            </label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">$</span>
                                </div>
                                <input type="number" class="form-control" id="amount"
                                       name="amount">
                            </div>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="vendor">Vendor<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="vendor" name="vendor" required>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="purpose">Purpose</label>
                            <textarea name="purpose" id="purpose" rows="5" class="form-control"></textarea>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-body" id="confirm-view"></div>
    </div>
    <div class="card-footer text-right">
        <button type="reset" class="btn btn-warning" form="form-edit" id="btnReset">Cancel</button>
        <button type="submit" id="btnReview" class="btn btn-primary" form="form-edit">Review & Submit</button>
        <button type="button" id="btnBackEdit" class="btn btn-dark" title="Back to Edit information">Back</button>
        <button type="submit" id="btnSave" class="btn btn-primary" form="form-edit">Submit</button>
    </div>
</div>