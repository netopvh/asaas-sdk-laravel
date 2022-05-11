<?php

namespace CreativeMobile\Asaas\Api;

use CreativeMobile\Asaas\Asaas;
use CreativeMobile\Asaas\Exception\AsaasRequestException;
use InvalidArgumentException;
use Jetimob\Http\Request;

abstract class AbstractApi extends \Jetimob\Http\AbstractApi
{
  protected ?string $exceptionClass = AsaasRequestException::class;

  protected function makeBaseRequest($method, $path, array $headers = [], $body = null): Request
  {
    return new AuthorizedRequest($method, $path, $headers, $body);
  }
}
