<?php
/**
 * @author    Rodion Smakota <rsmakota@svitla.com>
 * @copyright 2018 Svitla LTD
 */

namespace NasaBundle\Service;


use NasaBundle\Entity\Category;
use NasaBundle\Filter\FilterInterface;
use Doctrine\ORM\EntityManagerInterface;

class CategoryService implements EntityServiceInterface
{
    private $manager;

    /**
     * @param EntityManagerInterface $manager
     */
    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    public function find($id)
    {
        return $this->manager->getRepository(Category::class)->find($id);
    }

    /**
     * @param $name
     * @throws \Doctrine\ORM\ORMInvalidArgumentException
     */
    public function create($name)
    {
        $entity = new Category();
        $entity->setName($name);

        $this->manager->persist($entity);
        $this->manager->flush();
    }

    /**
     * @param FilterInterface $filter
     * @return Category[]
     */
    public function findAll(FilterInterface $filter)
    {
        return $this->manager->getRepository(Category::class)->findAll();
    }

    /**
     * @param integer $id
     * @param array $data
     * @return Category
     * @throws \Exception
     */
    public function update($id, $data)
    {
        $entity = $this->getCategory($id);
        $entity->setName($data['name']);

        $this->manager->merge($entity);
        $this->manager->flush();

        return $entity;
    }

    /**
     * @param integer $id
     * @throws \Exception
     */
    public function delete($id)
    {
        $entity = $this->getCategory($id);
        $this->manager->remove($entity);
        $this->manager->flush();
    }

    /**
     * @param integer $id
     * @return Category
     * @throws \Exception
     */
    private function getCategory($id)
    {
        $category = $this->find($id);
        if (!($category instanceof Category)) {
            throw new \Exception('Can\'t find category with id '.$id);
        }

        return $category;
    }
}