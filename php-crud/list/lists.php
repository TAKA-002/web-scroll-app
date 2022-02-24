<?php


function getWebpageLists()
{
  // jsonファイルを取得して、連想配列で返すようにdecodeする。連想配列が戻り値。
  return json_decode(file_get_contents(__DIR__ . '/../../common/data/webpage_list.json'), true);
}

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

function createUser($data)
{
}

function updateUser($data, $id)
{
}

function deleteUser($id)
{
}
