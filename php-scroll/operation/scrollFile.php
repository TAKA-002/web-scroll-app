<?php

/**
 * ファイル作成、ファイル名変更など、ファイルに関するクラス
 */
class ScrollFile
{
  private const ERR_STATUS_FLAG_TEXT = "このファイルは、JSONデータの「scrollFlag」項目が「false」のために出力されました。";
  private const ERR_STATUS_NO_PAGE_TEXT = "このファイルは、JSONデータの「url」が存在しないために出力されました。";
  private const ERR_STATUS_NO_CSS_TEXT = "このファイルは、JSONデータの「css」のURLが存在しないために出力されました。";
  private const ERR_STATUS_NO_JS_TEXT = "このファイルは、JSONデータの「js」のURLが存在しないために出力されました。";


  /**
   * ファイル作成
   * @param string $id jsonデータのid
   * @param string $dirName jsonデータのdirName
   * @param integer $err_status エラーコードの定数
   * @param string $extension 拡張子またはnull
   * @param string $data cssファイルやjsファイルのデータ
   */
  public function createFile($id, $dirName, $err_status, $extension, $data)
  {
    $filename = $this->createFileName($err_status, $extension);
    $filepath = $this->createFilePath($id, $dirName, $filename, $extension);
    $this->createDir($id, $dirName, $extension);

    // css・jsデータあり
    if (!is_null($data)) {
      $this->createNewFile($filepath, $data);
      return;
    }
    // css・jsデータなし
    $this->createErrFile($err_status, $filepath);
    return;
  }


  /**
   * 新規css/jsファイル作成
   * @param string $filepath 作成するファイルパス
   * @param string $data css・jsのデータ
   */
  private function createNewFile($filepath, $data)
  {
    $fp = fopen($filepath, "x");
    fwrite($fp, $data);
    fclose($fp);
  }


  /**
   * エラーテキストファイル作成
   * @param integer $err_status index.phpから送られてきた定数
   * @param string $filepath 作成するファイルパス
   */
  private function createErrFile($err_status, $filepath)
  {
    $fp = fopen($filepath, "x");
    if ($err_status === 1) {
      fwrite($fp, self::ERR_STATUS_FLAG_TEXT);
    }
    if ($err_status === 2) {
      fwrite($fp, self::ERR_STATUS_NO_PAGE_TEXT);
    }
    if ($err_status === 3) {
      fwrite($fp, self::ERR_STATUS_NO_CSS_TEXT);
    }
    if ($err_status === 4) {
      fwrite($fp, self::ERR_STATUS_NO_JS_TEXT);
    }
    fclose($fp);
  }


  /**
   * ファイル名作成
   * @param integer $err_status エラーコードの定数
   * @param string $extension 拡張子
   * @return string $filename yyyymmdd-err-flag.txt | yyyymmdd-err-page.txt | yyyymmdd-err-css.txt | yyyymmdd-err-js.txt | yyyymmdd-css.css | yyyymmdd-js.js
   */
  private function createFileName($err_status, $extension)
  {
    $txt = "";
    $d = new DateTime();

    // エラーコードあり（引数nullではない場合）
    if (!is_null($err_status)) {

      if ($err_status === 1 && $extension === null) {
        $txt = "flag";
      }
      if ($err_status === 2 && $extension === null) {
        $txt = "page";
      }
      if ($err_status === 3 && $extension === null) {
        $txt = "css";
      }
      if ($err_status === 4 && $extension === null) {
        $txt = "js";
      }

      $filename = $d->format('Ymd') . "-err-" . $txt . ".txt";
      return $filename;
    }

    // エラーコードなし(引数nullの場合)
    if ($extension === "css" || $extension === "js") {
      $filename = $d->format('Ymd') . "-" . $extension . "." . $extension;
      return $filename;
    }
  }


  /**
   * ファイルパス作成
   * @param string $id JSONの情報
   * @param string $dirName JSONの情報
   * @param string $filename createFileNameメソッドのreturn値
   * @param string $extension 拡張子
   * @return string $filepath フルパス
   */
  private function createFilePath($id, $dirName, $filename, $extension)
  {
    $filepath = dirname(__FILE__, 3) . "/output/" . $id . "_" . $dirName . "/" . $extension . "/" . $filename;
    $filepath = $this->unique_filename($filepath);

    return $filepath;
  }


  /**
   * ディレクトリ存在確認（なければ作成）
   * @param string $id JSONの情報
   * @param string $dirName JSONの情報
   * @param string $extension 拡張子
   */
  private function createDir($id, $dirName, $extension)
  {
    $path = dirname(__FILE__, 3) . "/output/" . $id . "_" . $dirName . "/" . $extension;
    if (!file_exists($path)) {
      mkdir($path, 0777, true);
    }
  }


  /**
   * 同じファイル名が存在していたら連番にする
   * @param string $original_path createFilePathで最初に作成されたパス
   * @param integer $num ファイルが重複していたときに追加するファイル名の連番
   * @return string $path パス
   */
  function unique_filename($original_path, $num = 0)
  {

    if ($num > 0) {
      $info = pathinfo($original_path);
      $path = $info['dirname'] . "/" . $info['filename'] . "_" . $num;
      if (isset($info['extension'])) $path .= "." . $info['extension'];
    } else {
      $path = $original_path;
    }

    if (file_exists($path)) {
      $num++;
      return $this->unique_filename($original_path, $num);
    } else {
      return $path;
    }
  }
}
