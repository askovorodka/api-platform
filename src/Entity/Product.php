<?php

namespace App\Entity;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use App\Validator\MinimalProperties; //A custom constraint

/**
 * Class Product
 * @package App\Entity
 * @ORM\Entity()
 * @ApiResource()
 */
class Product
{

    /**
     * @var int
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(name="id", type="integer")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string", name="name")
     * @Assert\NotBlank()
     */
    public $name;

    /**
     * @var string[]
     * @MinimalProperties
     * @ORM\Column(type="json")
     */
    public $properties;

    public function getId(): ?int
    {
        return $this->id;
    }

}