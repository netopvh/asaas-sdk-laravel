<?php

namespace CreativeMobile\Asaas\Middleware;

use Jetimob\Http\Authorization\Bearer\BearerTokenResolverContract;

class AccessTokenResolver implements BearerTokenResolverContract
{
  public function resolveToken(array $options): string
  {
    return config('asaas.http.access_token');
  }
}
