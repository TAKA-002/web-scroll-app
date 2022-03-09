<?php

/**
 * スクロール機能に関するクラス
 */
class Scroll
{

  public $json_file_path;

  /**
   * jsonファイルをデコードし、jsonデータのurlからページのソースを取得。
   * ページソースからスペースを除去。
   * ソースから、cssファイルをのパスを取得する
   * 
   */
  public function scroll_page($json_file_path)
  {
    // $decoded_lists_data = $this->get_scrolling_list($json_file_path);
    // $page_source = file_get_contents($decoded_lists_data[0]["url"]);
    $processed_html = $this->remove_space($page_source);

    // htmlソースの中から、cssファイルのパスを取得する
    $this->get_css_path($processed_html);
  }

  /**
   * private
   * jsonにアクセスしてデータをreturn
   * 
   * @param
   * jsonファイルのパス
   * 
   * @return array
   * デコードされたjsonデータ
   */
  private function get_scrolling_list($json_file_path)
  {
    $scroll_list_data = file_get_contents($json_file_path);
    $decoded_scroll_lists_data = json_decode($scroll_list_data, true);

    return $decoded_scroll_lists_data;
  }


  public function get_css_path($target_src)
  {
    $pos =  strpos($target_src, '.css');
    var_dump($pos);
  }

  //【一旦使用しない】：cssデータを取得してスペースを削除
  public function get_css_data($file_path)
  {
    $decoded_list_data = $this->get_scrolling_list($file_path);
    $css_data = file_get_contents($decoded_list_data[0]["csslink"]);
    $processed_css = $this->remove_space($css_data);

    return $processed_css;
  }




  // 文字列からスペースをすべて除去する
  private function remove_space($data)
  {
    $processed_data = str_replace(" ", "", $data);

    return $processed_data;
  }
}
