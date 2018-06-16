<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Class Review
 * @package App\Entity
 * @ORM\Entity()
 * @ApiResource()
 */
class Review
{
    /**
     * @var integer
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var int
     * @ORM\Column(type="smallint")
     * @Assert\Range(min="0", max="5")
     * @Groups("book")
     */
    public $rating;

    /**
     * @var string
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
     * @Groups({"book"})
     */
    public $body;

    /**
     * @var string
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     * @Groups({"book"})
     */
    public $author;

    /**
     * @var Book
     * @ORM\ManyToOne(targetEntity="Book", inversedBy="reviews")
     * @ORM\JoinColumn(referencedColumnName="id")
     * @Assert\NotNull()
     */
    public $book;

    /**
     * @var \DateTimeInterface
     * @ORM\Column(type="datetime")
     * @Assert\NotNull()
     */
    public $publicationDate;

    public function getId(): ?int {
        return $this->id;
    }

}