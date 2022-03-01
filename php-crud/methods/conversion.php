<?php
class Conversion
{
  public function convert_values($data)
  {
    if (!is_int($data['id'])) {
      $data['id'] = (int)$data['id'];
    }

    if ($data['scrollFlag'] === "true") {
      $data['scrollFlag'] = true;
    }

    if ($data['scrollFlag'] === "false") {
      $data['scrollFlag'] = false;
    }

    return $data;
  }
}
