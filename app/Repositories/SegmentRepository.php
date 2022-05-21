<?php

namespace App\Repositories;


/**
 *
 */
class SegmentRepository
{

    /**
     */
    private $model;

    /**
     */
    public function __construct( $contractOption )
    {
        $this->model = $contractOption;
    }// __construct

    /**
     * @param array $ids
     *
     * @return mixed
     */
    public function findByIDs( array $ids )
    {
        return $this->model::find( $ids );
    }// findByIDs

}// ContractOptionRepository
