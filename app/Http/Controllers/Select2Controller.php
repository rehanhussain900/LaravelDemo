<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\State;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 *
 */
class Select2Controller extends Controller
{

    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function cities( Request $request )
    {
        $query = City::whereCountryCode( 'US' );
        $term = $request->input( 'term' );
        if( !empty( $term ) ) {
            $query->where( 'name', 'LIKE', '%' . $term . '%' );
        }
        $cities = $query->get();
        $results = [];
        foreach( $cities as $row ) {
            $result = (object) [
                'id'   => $row->id,
                'text' => $row->name
            ];
            $results[] = $result;
        }

        return new JsonResponse( [ 'results' => $results ] );
    }// cities

    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function states( Request $request ) : JsonResponse
    {
        $query = State::whereCountryCode( 'US' );
        $term = $request->input( 'term' );
        if( !empty( $term ) ) {
            $query->where( 'name', 'LIKE', '%' . $term . '%' );
        }
        $cities = $query->get();
        $results = [];
        foreach( $cities as $row ) {
            $result = (object) [
                'id'   => $row->id,
                'text' => $row->name
            ];
            $results[] = $result;
        }

        return new JsonResponse( [ 'results' => $results ] );
    }// states

}// Select2Controller
