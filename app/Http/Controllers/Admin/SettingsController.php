<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Alert;
use App\Helpers\Theme;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class SettingsController extends Controller
{
    /**
     *
     */
    public function index()
    {
        return Theme::view( 'settings.index' );
    }

    /**
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function update( Request $request )
    {
        $settings = $request->settings;

        foreach( $settings as $key => $value ) {
            option( [ $key => $value ?? '' ] );
        }

        Alert::success( 'Settings Updated' );

        return redirect()->route( 'admin.settings' );
    }// update

    /**
     * @param $file
     *
     * @return \Illuminate\Http\Response|void
     */
    public function accessFiles( $file )
    {
        $file = Str::replace( '::', '.', $file );
        $file_path = Storage::disk( 'global' )->path( $file );
        if( file_exists( $file_path ) ) {
            $mime_type = File::mimeType( $file_path );
            return Response::make( File::get( $file_path ), 200, [ 'Content-Type' => $mime_type ] );
        }

        abort( '404' );
    }

    /**
     * @param $file
     *
     * @return BinaryFileResponse|void
     */
    public function downloadFile( $file )
    {
        $file = Str::replace( '::', '.', $file );
        $file_path = Storage::disk( 'global' )->path( $file );
        if( file_exists( $file_path ) ) {
            return Response::download( $file_path );
            $mime_type = File::mimeType( $file_path );
            return Response::make( File::get( $file_path ), 200, [ 'Content-Type' => $mime_type ] );
        }

        abort( '404' );
    }

}
