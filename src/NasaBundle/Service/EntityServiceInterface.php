<?php
/**
 * @author    Rodion Smakota <rsmakota@svitla.com>
 * @copyright 2018 Svitla LTD
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
    public function find($id);

    public function findAll(FilterInterface $filter);
    /**
     * @param array $data
     * @return EntityInterface
     * @throws \Exception
     */
    public function create($data);
    /**
     * @param integer $id
     * @param array $data
     * @return EntityInterface
     * @throws \Exception
     */
    public function update($id, $data);
    /**
     * @param integer $id
     * @throws \Exception
     */
    public function delete($id);
}