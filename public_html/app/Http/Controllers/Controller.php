<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Intervention\Image\Facades\Image;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /*
    * Получение значений поля ENUM
    */
    public static function getEnumValues($table, $column)
    {
      $type = DB::select( DB::raw("SHOW COLUMNS FROM $table WHERE Field = '$column'") )[0]->Type;
      preg_match('/^enum\((.*)\)$/', $type, $matches);
      $enum = array();
      foreach( explode(',', $matches[1]) as $value )
      {
        $v = trim( $value, "'" );
        $enum = array_add($enum, $v, $v);
      }
      return $enum;
    }

    /**
    * Сжатие изображения по ширине
    */
    public function imageResizeWidth($path)
    {
        // dd(public_path() . '/storage/' . $path);
        $img = Image::make(public_path() . '/storage/' . $path)->orientate()->widen(1280, function ($constraint) {
            $constraint->upsize();
        })->save();
    }
}
