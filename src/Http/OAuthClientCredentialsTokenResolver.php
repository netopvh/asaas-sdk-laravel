<?php

namespace CreativeMobile\Asaas\Http;

use GuzzleHttp\RequestOptions;
use Jetimob\Http\Authorization\OAuth\AccessToken;
use Jetimob\Http\Authorization\OAuth\OAuthClient;
use Jetimob\Http\Authorization\OAuth\OAuthFlow;
use Jetimob\Http\Authorization\OAuth\TokenResolvers\OAuthTokenResolver;

class OAuthClientCredentialsTokenResolver extends OAuthTokenResolver
{
  /**
   * @param OAuthClient $client
   * @param string|null $credentials
   * @return AccessToken
   * @throws \JsonException
   */
  public function resolveAccessToken(OAuthClient $client, ?string $credentials = null): AccessToken
  {
    return $this->issueAccessTokenRequest(
      $client,
      OAuthFlow::AUTHORIZATION_CODE
    );
  }
}
