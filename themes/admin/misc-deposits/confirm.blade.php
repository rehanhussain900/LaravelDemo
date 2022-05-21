<div class="row">
    <div class="col-md-6 col-12">
        <h3>Branch</h3>
        <p>{{$data[ 'branch' ]->name}}</p>
    </div>
    <div class="col-md-6 col-12">
        <h3>GL Account Number</h3>
        <p>{!! $data['gl_account']->label !!} ({{$data['gl_account']->number}})</p>
    </div>
</div>
<div class="row">
    <div class="col-md-6 col-12">
        <h3>Deposit Date</h3>
        <p>{!! \Carbon\Carbon::make($data['deposit_at'])->format('m/d/Y') !!}</p>
    </div>
    <div class="col-md-6 col-12">
        <h3>Amount</h3>
        <p>${!! number_format($data['amount']) !!}</p>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <h3>Vendor</h3>
        <p>{!! $data['vendor'] !!}</p>
    </div>
    <div class="col-12">
        <h3>Purpose</h3>
        <p>{!! $data['purpose'] !!}</p>
    </div>
</div>