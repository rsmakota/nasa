<?php
/**
 * @author    Rodion Smakota <rsmakota@svitla.com>
 * @copyright 2018 Svitla LTD
 */

namespace NasaBundle\Factory;


use Symfony\Component\HttpFoundation\Response;

interface ResponseFactoryInterface
{
    /**
     * @param mixed $data
     * @return Response
     */
    public function createDataResponse($data);

    /**
     * @param string $err
     * @return Response
     */
    public function createErrorResponse($err);

    /**
     * @return Response
     */
    public function createSuccessResponse();
}