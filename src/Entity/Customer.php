<?php

namespace CreativeMobile\Asaas\Entity;

use Jetimob\Http\Traits\Serializable;

class Customer
{
  use Serializable;

  /** @var string $name Nome do cliente. */
  protected string $name;

  /** @var string $document CPF do titular da conta bancária. Envie sem ponto ou traço. */
  protected string $document;

  /**
   * @return string
   */
  public function getName(): string
  {
    return $this->name;
  }

  /**
   * @return string
   */
  public function getDocument(): string
  {
    return $this->document;
  }

  /**
   * @param string $name Nome do titular da conta bancária.
   * @return AccountHolder
   */
  public function setName(string $name): Customer
  {
    $this->name = $name;
    return $this;
  }

  /**
   * @param string $document CPF do titular da conta bancária. Envie sem ponto ou traço.
   * @return AccountHolder
   */
  public function setDocument(string $document): Customer
  {
    $this->document = $document;
    return $this;
  }

  public static function new(string $name, string $document): self
  {
    return (new static())
      ->setName($name)
      ->setDocument($document);
  }
}
