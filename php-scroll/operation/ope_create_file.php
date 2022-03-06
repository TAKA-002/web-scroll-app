<?php

class CreateFile
{

  // ファイルを新規作成し、保存
  public function save_to_new_file($data)
  {
    // ファイル名を作成
    $date = $this->get_execution_date();

    // ディレクトリを指定
    $target_dir = dirname(__FILE__, 2);
    $file_name = $target_dir . "/output/" . $date . ".css";

    // ファイルを作成して開く
    $fp = fopen($file_name, "x");
    $is_write = fwrite($fp, $data);
    if ($is_write === false) {
      echo 'できん';
      return;
    }
    fclose($fp);
  }


  // phpファイル実行日時を取得
  private function get_execution_date()
  {
    date_default_timezone_set('Asia/Tokyo');

    return date('Ymd');
  }

  private function make_target_dir()
  {
    
  }
}
