<?php
require('conversion.php');

/**
 * jsonファイルから全jsonデータ取得後、連想配列をreturn。
 * 
 * @param
 * 
 * @return array{
 *  id: number,
 *  companyName: string,
 *  url: string,
 *  scrollFlag: bool
 * }
 * 
 */
function getWebpageLists()
{
  return json_decode(file_get_contents(__DIR__ . '/../../common/data/webpage_list.json'), true);
}


/**
 * 
 */
function getWebpageListsById($id)
{
  $web_page_all_data = getWebpageLists();
  foreach ($web_page_all_data as $item) {
    if ($item['id'] == $id) {
      return $item;
    }
  }
  return null;
}

function createItem($data)
{
  $web_page_all_data = getWebpageLists();
  $web_page_all_data[] = $data;
  putJson($web_page_all_data);
  return $data;
}


/**
 * ウェブページリストをアップデートし、webpage_list.jsonを更新
 * 
 * 使用ファイル：update.php
 * 
 * @param string
 * $data
 * formのmethod「POST」によって、submitボタンが押されたら$_SERVER['REQUEST_METHOD']が取得。（submitを押されたらPOSTで送信している）それが$_POSTで受けれる。
 * $id
 * index.phpでupdateボタンを押した際に送られたデータを$_GETで受け取り、そのデータの中のidキーを持ったもの
 * 
 */
function updateWebpageList($data, $id)
{
  $web_page_all_data = getWebpageLists();
  $conversion = new Conversion();

  foreach ($web_page_all_data as $i => $item) {
    if ($item['id'] == $id) {
      $convertedData = $conversion->convert_values($data);
      $web_page_all_data[$i] = array_merge($item, $convertedData);
    }
  }

  putJson($web_page_all_data);
}

function deleteUser($id)
{
}

function putJson($web_page_all_data)
{
  /**
   * json_encodeの第２引数に「JSON_PRETTY_PRINT」指定すると、jsonが整形されてエンコードされる
   */
  file_put_contents(__DIR__ . '/../../common/data/webpage_list.json', json_encode($web_page_all_data, JSON_PRETTY_PRINT));
}

/**
 * 新規IDの作成
 */
function createId($web_page_all_data)
{
  $random_number = random_int(1000, 2000);

  // 重複チェック
  foreach ($web_page_all_data as $item) {
    if ($item['id'] !== $random_number) {
      continue;
    };
    if ($item['id'] === $random_number) {
      return createId($web_page_all_data);
    }
  };

  return $random_number;
}
