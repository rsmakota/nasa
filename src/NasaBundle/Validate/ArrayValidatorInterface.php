<?php
/**
 * @author    Rodion Smakota <rsmakota@svitla.com>
 * @copyright 2018 Svitla LTD
 */

namespace NasaBundle\Validate;


interface ArrayValidatorInterface
{
    /**
     * @param array $data
     * @param array $fields
     * @throws \Exception
     */
    public function validateExist($data, array $fields);

    /**
     * @param array $data
     * @param array $fields
     * @throws \Exception
     */
    public function validateEmpty($data, array $fields);
}