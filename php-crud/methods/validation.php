<?php

class Validation
{

  /**
   * POSTデータがすべて揃っていることをチェックする
   * 
   * @param array {
   * ["id"] => string
   * ["companyName"] => string
   * ["url"] => string
   * ["scrollFlag"] => string
   * }
   */
  public function checkEmptyData($data)
  {
    foreach ($data as $item) {
      // "" ==> false
      if ($item === "") {
        return false;

        // NULL ==> false
        if (is_null($item)) {
          return false;
        }
      }
    }
    return true;
  }

  /**
   * POSTデータのurlがすでに全体のjsonデータに存在するか
   * 
   * @param $target array{
   * ["id"] => string
   * ["companyName"] => string
   * ["url"] => string
   * ["scrollFlag"] => string
   * }
   * 
   */
  public function checkDuplicateURLforUpdate($target, $web_page_all_data)
  {

    foreach ($web_page_all_data as $item) {

      // urlが異なっていたら次のitem
      if ($item['url'] != $target['url']) {
        continue;
      };

      // urlが同じならidもチェックし、同じなら編集中としてOK
      if ($item['url'] == $target['url']) {
        if ($item['id'] == $target['id']) {
          return true;
        }
        // それ意外はNG
        else {
          return false;
        }
      }

      // urlが異なっているだけならOK
      return true;
    }
  }

  /**
   * POSTデータのurlがすでに全体のjsonデータに存在するか
   * 
   * @param $target array{
   * ["id"] => string
   * ["companyName"] => string
   * ["url"] => string
   * ["scrollFlag"] => string
   * }
   * 
   */
  public function checkDuplicateURLforCreate($target, $web_page_all_data)
  {

    foreach ($web_page_all_data as $item) {

      // urlが異なっていたら次のitem
      if ($item['url'] != $target['url']) {
        continue;
      };

      // urlが同じならNG
      if ($item['url'] == $target['url']) {
        return false;
      }

      return true;
    }
  }
}
