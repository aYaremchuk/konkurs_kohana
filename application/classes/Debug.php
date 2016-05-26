<?php defined('SYSPATH') OR die('No direct script access.');

class Debug extends Kohana_Debug {
    
  // С помощью этой функции можем красиво вывести данные любого обжекта, массива итд...  
  public static function obj_dump($var) {
    if (function_exists('debug_backtrace')) {
      $Tmp1 = debug_backtrace();
    } else {
      $Tmp1 = array(
        'file' => 'UNKNOWN FILE',
        'line' => 'UNKNOWN LINE',
      );
    }
    echo "<FIELDSET STYLE=\"font:normal 12px helvetica,arial; margin:10px;\"><LEGEND STYLE=\"font:bold 14px helvetica,arial\">Dump - " . $Tmp1[0]['file'] . " : " . $Tmp1[0]['line'] . "</LEGEND><PRE>\n";
    echo htmlspecialchars(print_r($var, true));
    echo "</PRE></FIELDSET>\n\n";
  }
}
