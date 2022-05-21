<?php

namespace App\Helpers;

class Files
{

    /**
     * @param $path
     *
     * @return string
     */
    public static function imageToBase64( $path )
    {
        $type = pathinfo( $path, PATHINFO_EXTENSION );
        $content = file_get_contents( $path );
        $content = base64_encode( $content );
        return 'data:image/' . $type . ';base64,' . $content;
    }
}