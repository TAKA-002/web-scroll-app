<?php
date_default_timezone_set('Asia/Tokyo');


class ScrollWebpageSystem
{
  const DATA_PATH = __DIR__ . '/../common/data/webpage_list.json';



  // メインフロー
  public function main()
  {
    // jsonデータの取得
    $decoded_scroll_lists_data = $this->decode_data();

    // 各データブロックごとに処理を実施
    foreach ($decoded_scroll_lists_data as $item) {

      // 1.cssデータをoutput
      $result = $this->output_css_data($item);
    }
  }

  // ================================
  // 1.cssデータをoutput
  // ================================
  private function output_css_data($item)
  {
    // jsonデータのhtmlページのソースを取得する
    $page_source = $this->get_html_source($item['url']);

    // ページソースから「link rel=stylesheet」を探す。
    $this->get_stylesheet_link($page_source);
  }




  // ================================
  // sourceを取得する
  // ================================

  private function get_html_source($url)
  {
    $page_source = file_get_contents($url);
    return $page_source;
  }

  private function get_stylesheet_link($source)
  {
    $links = [];
    var_dump($source);
  }




  // ================================
  // jsonファイルのdecode・encode
  // ================================
  private function decode_data()
  {
    $json_data = file_get_contents(ScrollWebpageSystem::DATA_PATH);
    $json_data = mb_convert_encoding($json_data, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
    $decoded_data = json_decode($json_data, true);

    return $decoded_data;
  }
}


// 実行
$system = new ScrollWebpageSystem();
$system->main();
