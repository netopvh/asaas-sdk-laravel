<?php

namespace CreativeMobile\Asaas\Api;

use Jetimob\Http\Response;

trait HasEmbeddedData
{
  public function hydrate(array $dataObject): Response
  {
    if (array_key_exists('_embedded', $dataObject)) {
      $dataObject = $dataObject['_embedded'];
    }

    parent::hydrate($dataObject);
    return $this;
  }
}
