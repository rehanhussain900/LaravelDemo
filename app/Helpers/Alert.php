<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\ViewErrorBag;

/**
 *
 */
class Alert
{

    /**
     * @var string
     */
    private static $session_key = '_custom_alerts';

    /**
     * @param $message
     */
    public static function success( $message )
    {
        self::add( $message, 'success' );
    }// success

    /**
     * @param $message
     */
    public static function error( $message )
    {
        self::add( $message, 'error' );
    }// error

    public static function warning( $message )
    {
        self::add( $message, 'warning' );
    }// warning

    public static function info( $message )
    {
        self::add( $message, 'info' );
    }// info

    /**
     * @param $message
     * @param $status
     */
    private static function add( $message, $status )
    {
        $session = Session::get( self::$session_key, [] );
        if( !isset( $session[ $status ] ) ) {
            $session[ $status ] = [];
        }
        $session[ $status ][] = $message;
        Session::put( self::$session_key, $session );
    }// add


    /**
     * @param $status
     *
     * @return bool
     */
    public static function hasAlerts( $status )
    {
        return count( self::getAlerts( $status ) ) > 0;
    }// hasAlerts

    /**
     * @param $status
     *
     * @return array|mixed
     */
    public static function getAlerts( $status )
    {
        $session = Session::get( self::$session_key, [] );
        if( $status === 'error' ) {
            $validation = self::getValidationErrors();
            $session[ $status ] = array_merge( $session[ $status ] ?? [], $validation );
        }
        return $session[ $status ] ?? [];
    }// getAlerts

    /**
     *
     */
    public static function getValidationErrors()
    {
        /**
         * @var ViewErrorBag $errors
         */
        $errors = Session::get( 'errors' );
        if( !$errors instanceof ViewErrorBag ) {
            return [];
        }
        return $errors->getBag( 'default' )->all();
    }

    private static function reset( $status )
    {
        $session = Session::get( self::$session_key, [] );
        unset( $session[ $status ] );
        Session::put( self::$session_key, $session );
    }// reset

    /**
     * @param $status
     *
     * @return string
     */
    public static function parseAlerts( $status ) : string
    {
        $errors = self::getAlerts( $status );
        if( empty( $errors ) ) {
            return '';
        }
        self::reset( $status );
        if( count( $errors ) > 1 ) {
            return '<ul><li>' . implode( '</li><li>', $errors ) . '</li></ul>';
        }
        return $errors[ 0 ];
    }// parseAlerts

}// Alert
