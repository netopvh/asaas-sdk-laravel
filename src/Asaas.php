<?php

namespace CreativeMobile\Asaas;

use CreativeMobile\Asaas\Exception\RuntimeException;
use Jetimob\Http\Contracts\HttpProviderContract;
use Jetimob\Http\Http;

class Asaas implements HttpProviderContract
{

  protected Http $client;
  protected array $config;

  public function __construct(array $config = [])
  {
    $this->client = new Http($config['http'] ?? []);
    $this->config = $config;
  }

  /**
   * @return Http
   */
  public function getHttpInstance(): Http
  {
    return $this->client;
  }

  /**
   * @return array
   */
  public function getConfig(): array
  {
    return $this->config ?? [];
  }

  /**
   * Retorna uma data do tipo ISO 8601, utilizada pela Juno.
   *
   * @param int|string $year
   * @param int|string $month
   * @param int|string $day
   * @return string
   */
  public function dateToString($year, $month, $day): string
  {
    return sprintf('%s-%02s-%02s', $year, $month, $day);
  }

  public function __call(string $name, array $arguments)
  {
    if (!($apiImpl = $this->config['api_impl'] ?? null) || !array_key_exists($name, $apiImpl)) {
      throw new RuntimeException("O endpoint '$name' não foi implementado ou não existe");
    }

    return new $apiImpl[$name]($this);
  }
}
