<?php

class ExistValidation
{

  public function urlExists($url)
  {
    if (!$url && !is_string($url)) {
      return false;
    }

    $headers = @get_headers($url);
    if (preg_match('/[2][0-9][0-9]|[3][0-9][0-9]/', $headers[0])) {
      return true;
    } else {
      return false;
    }
  }
}
