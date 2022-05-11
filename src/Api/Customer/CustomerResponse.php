<?php

namespace CreativeMobile\Asaas\Api\Customer;

use Jetimob\Http\Response;

abstract class CustomerResponse extends Response
{
  protected string $name;
  protected string $email;

  /**
   * Get the value of name
   *
   * @return string
   */
  public function getName(): string
  {
    return $this->name;
  }

  /**
   * Get the value of email
   *
   * @return string
   */
  public function getEmail(): string
  {
    return $this->email;
  }
}
