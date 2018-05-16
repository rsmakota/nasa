<?php
/**
 * @author    Rodion Smakota <rsmakota@gmail.com>
 * @copyright 2018 INNOVECS
 */

namespace NasaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="NasaBundle\ORM\NearEarthObjectRepository")
 * @ORM\Table(name="near_earth_objects")
 */
class NearEarthObject implements EntityInterface
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @ORM\Column(type="date")
     */
    private $date;
    /**
     * @ORM\Column(type="integer")
     */
    private $reference;
    /**
     * @ORM\Column(type="string")
     */
    private $name;
    /**
     * @ORM\Column(type="decimal", scale=10)
     */
    private $speed;
    /**
     * @ORM\Column(name="is_hazardous", type="boolean")
     */
    private $isHazardous;

    /**
     * @return integer
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param integer $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return \DateTime
     */
    public function getDate(): \DateTime
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     */
    public function setDate(\DateTime $date)
    {
        $this->date = $date;
    }

    /**
     * @return integer
     */
    public function getReference(): int
    {
        return $this->reference;
    }

    /**
     * @param integer $reference
     */
    public function setReference(int $reference): void
    {
        $this->reference = $reference;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getSpeed(): string
    {
        return $this->speed;
    }

    /**
     * @param string $speed
     */
    public function setSpeed(string $speed): void
    {
        $this->speed = $speed;
    }

    /**
     * @return boolean
     */
    public function getIsHazardous(): bool
    {
        return $this->isHazardous;
    }

    /**
     * @param boolean $isHazardous
     */
    public function setIsHazardous(bool $isHazardous): void
    {
        $this->isHazardous = $isHazardous;
    }



}