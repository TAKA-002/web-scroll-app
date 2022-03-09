<?php

class Validation
{

  /**
   * POSTデータがすべて揃っていることをチェックする
   * 
   * @param $data array {
   * ["id"] => string
   * ["companyName"] => string
   * ["dirName"] => string
   * ["url"] => string
   * ["css"] => string
   * ["js"] => string
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
   * @param $data array{
   * ["id"] => string
   * ["companyName"] => string
   * ["url"] => string
   * ["scrollFlag"] => string
   * }
   * 
   */
  public function checkDuplicateURLforUpdate($data, $web_page_all_data)
  {
    foreach ($web_page_all_data as $item) {

      // urlが異なっていたら次のitem
      if ($item['url'] != $data['url']) {
        continue;
      };

      // urlが同じならidもチェックし、同じなら編集中としてOK
      if ($item['url'] == $data['url']) {
        if ($item['id'] == $data['id']) {
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
   * @param $data array{
   * ["id"] => string
   * ["companyName"] => string
   * ["dirName"] => string
   * ["url"] => string
   * ['css'] => string
   * ['js'] => string
   * ["scrollFlag"] => string
   * }
   * 
   */
  public function checkDuplicateURLforCreate($data, $web_page_all_data)
  {
    foreach ($web_page_all_data as $item) {

      // urlが異なっていたら次のitem
      if ($item['url'] != $data['url']) {
        continue;
      };

      // urlが同じならNG
      if ($item['url'] == $data['url']) {
        return false;
      }

      return true;
    }
  }

  /**
   * postのdirNameデータが半角英数字になっているかチェック
   * 
   * @param $data Strings
   */
  public function checkStrings($data)
  {
    if (preg_match("/^[a-zA-Z0-9]+$/", $data)) {
      return true;
    } else {
      return false;
    }
  }
}
