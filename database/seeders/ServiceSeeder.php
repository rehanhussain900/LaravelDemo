<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

/**
 *
 */
class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $services = [
            [
                'name' => 'Animal Trapping (wildlife control)',
            ],
            [
                'name'     => 'Exclusion Repairs',
                'children' => [
                    [
                        'name' => 'Full Exclusion Repairs'
                    ],
                    [
                        'name' => 'Partial Exclusion Repairs',
                    ],
                    [
                        'name' => 'Excluder Device	',
                    ]
                ]
            ],
            [
                'name' => 'Sanitization',
            ],
            [
                'name' => 'Recurring Service',
            ],
            [
                /*'name'     => 'Additional Services',
                'children' => [
                    [*/
                'name' => 'Insect (insecticide) treatment'
                /*],*//*
                    [
                        'name' => 'bird control',
                    ],*/
                /*]*/
            ]
        ];

        foreach( $services as $i => $service ) {
            $service[ 'sort_order' ] = ++$i;
            $children = $service[ 'children' ] ?? [];
            unset( $service[ 'children' ] );
            $model = Service::create( $service );
            if( !empty( $children ) ) {
                foreach( $children as $j => $ser ) {
                    $ser[ 'sort_order' ] = ++$j;
                    $ser[ 'parent_id' ] = $model->id;
                    Service::create( $ser );
                }
            }
        }
    }
}
