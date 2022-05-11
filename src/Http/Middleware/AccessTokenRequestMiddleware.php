<?php

namespace CreativeMobile\Asaas\Http\Middleware;

use Closure;
use CreativeMobile\Asaas\Exception\RuntimeException;
use Jetimob\Http\Authorization\Bearer\BearerTokenResolverContract;
use Jetimob\Http\Http;
use Psr\Http\Message\RequestInterface;

class AccessTokenRequestMiddleware
{
  private Http $http;

  public function __construct(Http $http)
  {
    $this->http = $http;
  }

  public function __invoke(callable $handler): Closure
  {
    return function (RequestInterface $request, array $options) use ($handler) {
      $accessToken = $this->http->getConfig('authorization_header_access_token');

      if (\is_null($accessToken)) {
        throw new RuntimeException(
          'There is no "authorization_access_bearer_token" defined in the configuration array'
        );
      }

      if (!is_string($accessToken)) {
        throw new RuntimeException(
          '"authorization_header_access_token" MUST be an string or a class'
        );
      }

      if (class_exists($accessToken)) {
        $instance = new $accessToken();

        if (!($instance instanceof BearerTokenResolverContract)) {
          throw new RuntimeException(
            '"authorization_header_access_token" class MUST implement BearerTokenResolverContract'
          );
        }

        $accessToken = $instance->resolveToken($options);
      }

      $request = $request->withHeader('access_token', $accessToken);
      $this->http->setLastRequest($request);

      return $handler($request, $options);
    };
  }
}
