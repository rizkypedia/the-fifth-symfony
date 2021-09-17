<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\BooleanFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\RangeFilter;
use ApiPlatform\Core\Bridge\Symfony\Validator\Validator;
use ApiPlatform\Core\Serializer\Filter\PropertyFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CheeseListingRepository;
use Carbon\Carbon;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\SerializedName;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ApiResource(
 *      collectionOperations={"get","post"},
 *      itemOperations={
 *          "get"={
 *              "normalization_context"={"groups"={"cheese_listing:read","cheese_listing:item:get"}}
 *          },
 *          "put"
 *      },
 *      normalizationContext={"groups"={"cheese_listing:read"}},
 *      denormalizationContext={"groups"={"cheese_listing:write"}},
 *      shortName="cheeses",
 *      attributes={
 *          "pagination_items_per_page"=5,
 *          "formats"={"jsonld","json","html","csv"={"text/csv"}} *         
 *      }
 * )
 * 
 * 
 * @ApiFilter(BooleanFilter::class, properties={"isPublished"})
 * @ApiFilter(SearchFilter::class, properties={
 *      "title":"partial",
 *      "description":"partial",
 *      "owner":"exact",
 *      "owner.username":"partial"    
 *  }
 * )
 * @ApiFilter(RangeFilter::class, properties={"price"})
 * @ApiFilter(PropertyFilter::class)
 * @ORM\Entity(repositoryClass=CheeseListingRepository::class)
 */

class CheeseListing
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"cheese_listing:read","cheese_listing:write","user:read","user:write"})
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min=2,
     *      max=50,
     *      maxMessage="Describe your cheese in 50 chars or less"
     * )
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     * @Groups({"cheese_listing:read"})
     * @Assert\NotBlank()
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"cheese_listing:read","cheese_listing:write","user:read","user:write"})
     * @Assert\NotBlank()
     */
    private $price;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isPublished=false;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="cheeseListings")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"cheese_listing:read", "cheese_listing:write"})
     * @Assert\Valid()
     */
    private $owner;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    } 
    
    /**
     * @Groups({"cheese_listing:read"})
     */
    public function getShortDescription():?string
    {
        if (strlen($this->description) < 40){
            return $this->description;
        }
        return substr($this->description,0,40) . '...';

    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

     /**
     * The description of the cheese as raw text.
     *
     * @Groups({"cheese_listing:write","user:write"})
     * 
     * @SerializedName("description")
     * 
     */
    public function setTextDescription(string $description): self
    {
        $this->description = nl2br($description);

        return $this;
    }
    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    /**
     * @Groups("cheese_listing:read")
     */
    public function getCreatedAtAgo(): string
    {
       return Carbon::instance($this->getCreatedAt())->diffForHumans();
    }

    public function getIsPublished(): ?bool
    {
        return $this->isPublished;
    }

    public function setIsPublished(bool $isPublished): self
    {
        $this->isPublished = $isPublished;

        return $this;
    }

    public function getOwner(): ?User
    {
        return $this->owner;
    }

    public function setOwner(?User $owner): self
    {
        $this->owner = $owner;

        return $this;
    }
}
