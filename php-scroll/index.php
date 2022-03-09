<?php
date_default_timezone_set('Asia/Tokyo');

require_once('./validation/listValidation.php');


class ScrollWebPageSystem
{
  const SCROLL_LIST_FILE_PATH = '../common/data/webpage_list.json';
  const ERR_STATUS_FLAG = 1;
  const ERR_STATUS_NO_PAGE = 2;
  const ERR_STATUS_NO_CSS = 3;
  const ERR_STATUS_NO_JS = 4;


  public function main()
  {

    // scrollを実行
    $this->scroll();
  }



  // ================================
  // スクロール
  // ================================

  private function scroll()
  {

    // jsonファイルから配列のjsonデータを取得
    $scroll_list_data = $this->get_json_list(self::SCROLL_LIST_FILE_PATH);

    foreach ($scroll_list_data as $i => $item) {

      $exist_validation = new ExistsValidation();

      // ============================================
      // jsonのscrollFlagを確認する
      // ============================================
      if ($item['scrollFlag'] === false) {
        // falseの場合は、scrollflagがfalse判定されたことをテキストファイルに出力予定
        // scrollFlagがfalseだということをファイル名でわかるように。
        $this->create_err_file($item['dirName'], self::ERR_STATUS_FLAG);
        exit;
        // falseは処理を行わないためcontinueで以下の処理をすべてスキップ
        continue;
      }

      // ============================================
      // scrollがtrueの場合は、jsonのurlからページが存在しているか確認
      // ============================================
      $page_exist_result = $exist_validation->url_exists($item['url']);

      // ページが存在していなかった時の処理
      if ($page_exist_result === false) {
        // 存在していなかったことを明確にするためにテキストファイルを出力予定
        // htmlページがないエラーだということをファイル名でわかるように。
        $this->create_err_file($item['dirName'], self::ERR_STATUS_NO_PAGE);

        // falseは処理を行わないためcontinueで以下の処理をすべてスキップ

        continue;
      }


      // ============================================
      // ページが存在していたらjsonに記載のCSSとJSを取得
      // ============================================
      $css_exist_result = $exist_validation->url_exists($item["css"]);
      $js_exist_result = $exist_validation->url_exists($item["js"]);

      if ($css_exist_result === false) {
        // 存在していなかったことを明確にするためにテキストファイルを出力予定
        // cssページがないエラーだということをファイル名でわかるように。
        $this->create_err_file($item['dirName'], self::ERR_STATUS_NO_CSS);

        // continueはいらない。


      } else {
        $css_data = file_get_contents($item["css"]);
        var_dump($css_exist_result);
      }

      if ($js_exist_result === false) {
        // 存在していなかったことを明確にするためにテキストファイルを出力予定
        // jsページがないエラーだということをファイル名でわかるように。
        $this->create_err_file($item['dirName'], self::ERR_STATUS_NO_JS);

        // continueはいらない。


      } else {
        $css_data = file_get_contents($item["js"]);
        var_dump($js_exist_result);
      }
    };
  }


  /**
   * jsonファイルのパスから、デコードしたデータを返す
   * @param $file_path
   * ファイルのパス
   * @return $decoded_list_data
   * デコードされたjsonデータ
   */
  private function get_json_list($file_path)
  {
    $list_data = file_get_contents($file_path);
    $decoded_list_data = json_decode($list_data, true);
    return $decoded_list_data;
  }

  // yyyymmdd-err-fg
  private function create_err_file($dirName, $err_status)
  {
    $err_file_name = $this->create_file_name($err_status);
  }

  private function create_file_name($err_status)
  {
    $txt = "";
    $d = new DateTime();
    var_dump($d->format('Ymd'));

    if ($err_status !== "") {

      if ($err_status === 1) {
        $txt = "flag";
      }
      if ($err_status === 2) {
        $txt = "nopage";
      }
      if ($err_status === 3) {
        $txt = "nocss";
      }
      if ($err_status === 4) {
        $txt = "nojs";
      }

      $filename = `{$d->format('Ymd')}-err-{$txt}.txt`;
    } else {
      $filename = `{$d->format('Ymd')}{$txt}`;
    }
  }
}

$system = new ScrollWebPageSystem();
$system->main();
