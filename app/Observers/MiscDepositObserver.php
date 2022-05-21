<?php

namespace App\Observers;

use Illuminate\Support\Facades\Auth;

class MiscDepositObserver
{

    /**
     * @param $model
     */
    public function creating( $model )
    {
        $model->user_id = Auth::id();
    }// creating
}
