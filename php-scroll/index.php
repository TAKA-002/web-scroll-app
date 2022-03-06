<?php
require('operation/ope_scroll.php');
require('operation/ope_create_file.php');

const SCROLL_LIST_FILE_PATH = 'lists/scroll-list.json';

$scroll_ope = new ScrollOperation();
$create_file = new CreateFile();

// スクロールしたいWEBページはlists/scroll-list.jsonに記載されているのでそのデータをdecodeして取得する
$html = $scroll_ope->scroll_page(SCROLL_LIST_FILE_PATH);




// $decoded_data = $scroll_ope->get_scrolling_list(SCROLL_LIST_FILE_PATH);

// $str_css = $scroll_ope->get_css_data(SCROLL_LIST_FILE_PATH);

// データをファイルに保存
// $create_file->save_to_new_file($str_css);
