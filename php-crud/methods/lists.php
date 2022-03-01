<?php
require('conversion.php');

/**
 * jsonファイルを取得後、連想配列をreturn。
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
  $webpagelists = getWebpageLists();
  foreach ($webpagelists as $item) {
    if ($item['id'] == $id) {
      return $item;
    }
  }
  return null;
}

function createItem($data)
{
  $webpagelists = getWebpageLists();
  $webpagelists[] = $data;
  putJson($webpagelists);
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
  $webpagelists = getWebpageLists();
  $conversion = new Conversion();

  foreach ($webpagelists as $i => $item) {
    if ($item['id'] == $id) {
      $convertedData = $conversion->convert_values($data);
      echo '<pre>';
      var_dump($convertedData);
      echo '</pre>';
      $webpagelists[$i] = array_merge($item, $convertedData);
    }
  }

  putJson($webpagelists);
}

function deleteUser($id)
{
}

function putJson($webpagelists)
{
  /**
   * json_encodeの第２引数にこれを指定すると、jsonが整形されてエンコードされる
   */
  file_put_contents(__DIR__ . '/../../common/data/webpage_list.json', json_encode($webpagelists, JSON_PRETTY_PRINT));
}
