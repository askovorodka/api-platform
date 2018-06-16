<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Book
 * @package App\Entity
 * @ORM\Entity
 * @ApiResource(attributes={
 *     "normalization_context"={"groups"={"book"}}
 *     })
 */
class Book
{

    /**
     * @var int
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string|null
     * @ORM\Column(nullable=true)
     * @Assert\Isbn()
     * @Groups({"book"})
     */
    public $isbn;

    /**
     * @var string
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     * @Groups({"book"})
     */
    public $title;

    /**
     * @var string
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
     */
    public $description;

    /**
     * @var string
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     */
    public $author;

    /**
     * @var \DateTimeInterface
     * @ORM\Column(type="datetime")
     * @Assert\NotNull()
     */
    public $publicationDate;

    /**
     * @var Review[]
     * @ORM\OneToMany(targetEntity="Review", mappedBy="book")
     */
    public $reviews;

    public function __construct()
    {
        $this->reviews = new ArrayCollection();
    }

    public function getId(): ?int {
        return $this->id;
    }


}