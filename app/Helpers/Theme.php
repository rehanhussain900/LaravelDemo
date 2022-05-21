<?php


namespace App\Helpers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

/**
 * Class Theme
 * @package App\Helpers
 */
class Theme
{
    /**
     * @var
     */
    private static $theme;

    /**
     * @param null $view
     * @param array $data
     * @param array $mergeData
     *
     * @return Application|Factory|View
     */
    public static function view( $view = null, array $data = [], array $mergeData = [] )
    {
        $view = self::$theme . '.' . $view;
        return view( $view, $data, $mergeData );
    }// view

    /**
     * @param mixed $theme
     */
    public static function setTheme( $theme ) : void
    {
        self::$theme = $theme;
    }
}
