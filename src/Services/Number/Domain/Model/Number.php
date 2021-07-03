<?php

namespace App\Services\Number\Domain\Model;

use App\Services\Number\Domain\ValueObject\Country;
use App\Services\Number\Infrastructure\Repository\NumberRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=NumberRepository::class)
 * @ORM\Table(name="customer")
 */
class Number
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $phone;

    private Country $country;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getPhone($withoutCountryCode = false): ?string
    {
        return $withoutCountryCode?substr($this->phone,5):$this->phone;
    }

    public function getCountry(): Country
    {
        return $this->country;
    }

    public function assignCountry(Country $country): void
    {
        $this->country = $country;
    }

    public function getCountryCode(): int
    {
        return (int) substr($this->getPhone(),1, 3);
    }

    public function isValid(): bool
    {
        return (bool) preg_match("/".$this->getCountry()->getMatchExpression()."/", $this->getPhone());
    }
}
