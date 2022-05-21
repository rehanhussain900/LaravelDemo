<?php

namespace App\Services;

use App\Repositories\SegmentRepository;
use App\Repositories\ContractRepository;
use Illuminate\Support\Facades\Storage;

/**
 *
 */
class SegmentService
{
    /**
     * @var SegmentRepository
     */
    private $repository;

    /**
     * @param SegmentRepository $contractRepository
     */
    public function __construct( SegmentRepository $contractRepository )
    {
        $this->repository = $contractRepository;
    }// __construct

    /**
     * @param array $options
     *
     * @return mixed
     */
    public function prepareForSigning( array $options )
    {
        $options = $this->repository->findByIDs( $options );
        foreach( $options as $option ) {
            $option->segment = str_replace( '::', '.', $option->segment );
            $option->segment = Storage::disk( 'global' )->path( $option->segment );
        }
        return $options;
    }// prepareForSigning

}// ContractOptionService
