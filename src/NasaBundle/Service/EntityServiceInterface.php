<?php
/**
 * @author    Rodion Smakota <rsmakota@gmail.com>
 * @copyright 2018 INNOVECS
 */

namespace NasaBundle\Service;

use NasaBundle\Entity\EntityInterface;
use NasaBundle\Filter\FilterInterface;

interface EntityServiceInterface
{
    /**
     * @param integer $id
     *
     * @return EntityInterface|null
     */
    public function find($id): ?EntityInterface;

    public function findAll(FilterInterface $filter);
    /**
     * @param array $data
     *
     * @return EntityInterface
     * @throws \Exception
     */
    public function create(array $data): EntityInterface;
    /**
     * @param integer $id
     * @param array $data
     *
     * @return EntityInterface
     * @throws \Exception
     */
    public function update(int $id, array $data): EntityInterface;
    /**
     * @param integer $id
     * @throws \Exception
     */
    public function delete(int $id): void;
}