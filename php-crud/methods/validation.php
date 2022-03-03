<?php

class Validation
{

  /**
   * POSTデータが揃っていることをチェックする
   * 
   * @param array(4) {
   * ["id"] => string
   * ["companyName"] => string
   * ["url"] => string
   * ["scrollFlag"] => string
   * }
   */
  public function checkEmptyData($data)
  {
    foreach ($data as $item) {
      // ""はfalse
      if ($item === "") {
        return false;

        // NULLはfalse
        if (is_null($item)) {
          return false;
        }
      }
    }
    return true;
  }
}
