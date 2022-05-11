<?php

namespace CreativeMobile\Asaas\Api\Customer;

use CreativeMobile\Asaas\Api\AbstractApi;
use CreativeMobile\Assas\Api\Customer\CustomerListResponse;

class CustomerApi extends AbstractApi
{
  public function list()
  {
    return $this->mappedGet('customers', CustomerListResponse::class);
  }
}
