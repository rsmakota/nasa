<?php

namespace NasaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Entity(repositoryClass="BlogBundle\ORM\PostRepository")
* @ORM\Table(name="posts")
 */
class Post implements EntityInterface
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @ORM\Column(type="string")
     */
    private $author;
    /**
     * @ORM\Column(type="datetime")
     */
    private $created;
    /**
     * @ORM\Column(type="text")
     */
    private $text;
    /**
     * @ORM\ManyToOne(targetEntity="BlogBundle\Entity\Category")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     * @var Category
     */
    private $category;

    /**
     * Post constructor.
     */
    public function __construct()
    {
        $this->created = new \DateTime();
    }


    public function getCategory()
    {
        return $this->category;
    }

    public function setCategory($category)
    {
        $this->category = $category;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function setAuthor($author)
    {
        $this->author = $author;
    }

    public function getCreated()
    {
        return $this->created;
    }

    public function setCreated($created)
    {
        $this->created = $created;
    }

    public function getText()
    {
        return $this->text;
    }

    public function setText($text)
    {
        $this->text = $text;
    }



}