<?php

namespace CreativeMobile\Asaas\Facades;

use Illuminate\Support\Facades\Facade;

class Asaas extends Facade
{
  /**
   * Get the registered name of the component.
   *
   * @return string
   */
  protected static function getFacadeAccessor()
  {
    return 'creativemobile.asaas';
  }
}
