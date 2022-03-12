<?php
date_default_timezone_set('Asia/Tokyo');

// require_once('./validation/existValidation.php');
// require_once('./operation/scrollFile.php');
require_once(dirname(__FILE__) . '/validation/existValidation.php');
require_once(dirname(__FILE__) . '/operation/scrollFile.php');


class ScrollWebPageSystem
{
  private const SCROLL_LIST_FILE_PATH = __DIR__ . '/../common/data/webpage_list.json';

  private const ERR_STATUS_FLAG = 1;
  private const ERR_STATUS_NO_PAGE = 2;
  private const ERR_STATUS_NO_CSS = 3;
  private const ERR_STATUS_NO_JS = 4;
  private const NO_ERR = null;
  private const NO_EXTENTION = null;
  private const NO_DATA = null;


  public function main()
  {
    $this->scroll();
  }


  // ================================
  // スクロール
  // ================================

  private function scroll()
  {

    $exist_validation = new ExistValidation();
    $scroll_file = new ScrollFile();
    $scroll_list_data = $this->getJsonList(self::SCROLL_LIST_FILE_PATH);

    foreach ($scroll_list_data as $i => $item) {

      // scrollFlag確認：false => false判定されたことをテキストファイルに出力
      if ($item['scrollFlag'] === false) {
        $scroll_file->createFile($item['id'], $item['dirName'], self::ERR_STATUS_FLAG, self::NO_EXTENTION, self::NO_DATA);

        // scrollFlag => false：以降処理を行わないため、continue
        continue;
      }


      // scrollFlag確認：true => urlページの存在確認
      $page_exist_result = $exist_validation->urlExists($item['url']);

      // ページ存在しない
      if ($page_exist_result === false) {
        // テキストファイルを出力
        $scroll_file->createFile($item['id'], $item['dirName'], self::ERR_STATUS_NO_PAGE, self::NO_EXTENTION, self::NO_DATA);

        // ページなし => 以降の処理は不要、continue
        continue;
      }


      // ページ存在あり => CSSとJSの存在確認
      $css_exist_result = $exist_validation->urlExists($item["css"]);
      $js_exist_result = $exist_validation->urlExists($item["js"]);

      if ($css_exist_result === false) {
        // CSSなし => テキストファイル出力（continueはしない）
        $scroll_file->createFile($item['id'], $item['dirName'], self::ERR_STATUS_NO_CSS, self::NO_EXTENTION, self::NO_DATA);
      }
      // CSSあり => ファイルの内容を取得後、ファイル生成
      else {
        $extension = "css";
        $css_data = file_get_contents($item["css"]);

        $scroll_file->createFile($item['id'], $item['dirName'], self::NO_ERR, $extension, $css_data);
      }

      // JSなし
      if ($js_exist_result === false) {
        $scroll_file->createFile($item['id'], $item['dirName'], self::ERR_STATUS_NO_JS, self::NO_EXTENTION, self::NO_DATA);
      }
      // JSあり
      else {
        $extension = "js";
        $js_data = file_get_contents($item["js"]);

        $scroll_file->createFile($item['id'], $item['dirName'], self::NO_ERR, $extension, $js_data);
      }
    };

    return;
  }


  /**
   * jsonファイルのパスから、デコードしたデータを返す
   * @param string $file_path ファイルのパス
   * @return array $decoded_list_data デコードされたjsonデータ
   */
  private function getJsonList($file_path)
  {
    $list_data = file_get_contents($file_path);
    $decoded_list_data = json_decode($list_data, true);
    return $decoded_list_data;
  }
}


$system = new ScrollWebPageSystem();
$system->main();
