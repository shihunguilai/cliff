<?php

namespace shihunguilai\phpapi\Util;

class ApiUtil
{
    /**
   * [myserialize description].
   *
   * @param  [mixed] $data [description]
   *
   * @return [string]       [description]
   */
  public static function myserialize($data)
  {
      return base64_encode(gzcompress(serialize($data)));
  }

    public static function myunserialize($data)
    {
        return unserialize(gzuncompress(base64_decode($data)));
    }

    final public static function myExplode($str, $delimiter)
    {
        $ss = trim($str);
        $ss = trim($ss, $delimiter);
        if (empty($ss)) {
            return array();
        }
        $arr = explode($delimiter, $str);

        return empty($arr) ? array() : $arr;
    }
}
