<?php
/**
 * @author    Rodion Smakota <rsmakota@gmail.com>
 * @copyright 2018 INNOVECS
 */

namespace NasaBundle\Service;

use NasaBundle\Entity\EntityInterface;
use NasaBundle\Entity\NearEarthObject;
use NasaBundle\Filter\FilterInterface;
use Doctrine\ORM\EntityManagerInterface;

class NearEarthObjectService implements EntityServiceInterface
{
    private $manager;

    /**
     * @param EntityManagerInterface $manager
     */
    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    public function find($id): ?EntityInterface
    {
        return $this->manager->getRepository(NearEarthObject::class)->find($id);
    }

    /**
     * @param array $data
     * @return EntityInterface
     */
    public function create(array $data): EntityInterface
    {
        $entity = new NearEarthObject();
        $entity->setDate(new \DateTime($data['date']));
        $entity->setName($data['name']);
        $entity->setReference($data['reference']);
        $entity->setSpeed($data['speed']);
        $entity->setIsHazardous($data['isHazardous']);

        $this->manager->persist($entity);
        $this->manager->flush();

        return $entity;
    }

    /**
     * @param FilterInterface $filter
     * @return NearEarthObject[]
     */
    public function findAll(FilterInterface $filter): array
    {
        return $this->manager->getRepository(NearEarthObject::class)->findAll();
    }

    /**
     * @param integer $id
     * @param array $data
     * @return NearEarthObject
     * @throws \Exception
     */
    public function update(int $id, array $data): EntityInterface
    {
        $entity = $this->getNearEarthObject($id);
        $entity->setName($data['name']);

        $this->manager->merge($entity);
        $this->manager->flush();

        return $entity;
    }

    /**
     * @param integer $id
     * @throws \Exception
     */
    public function delete(int $id): void
    {
        $entity = $this->getNearEarthObject($id);
        $this->manager->remove($entity);
        $this->manager->flush();
    }

    /**
     * @param integer $id
     * @return NearEarthObject
     * @throws \Exception
     */
    private function getNearEarthObject($id): NearEarthObject
    {
        $category = $this->find($id);
        if (!($category instanceof NearEarthObject)) {
            throw new \RuntimeException('Can\'t find category with id '.$id);
        }

        return $category;
    }
}