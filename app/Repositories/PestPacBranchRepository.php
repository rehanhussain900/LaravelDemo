<?php

namespace App\Repositories;

use App\Models\PestPacBranch;

/**
 *
 */
class PestPacBranchRepository
{

    /**
     *
     */
    public function __construct()
    {

    }

    /**
     * @param $checkAttribute
     * @param $updateAttribute
     *
     * @return mixed
     */
    public function updateOrCreate( $checkAttribute, $updateAttribute )
    {
        return PestPacBranch::updateOrCreate( $checkAttribute, $updateAttribute );
    }

}// PestPacBranchRepository
