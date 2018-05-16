<?php
/**
 * @author    Rodion Smakota <rsmakota@gmail.com>
 * @copyright 2018 INNOVECS
 */

namespace NasaBundle\Factory;


use JMS\Serializer\SerializerBuilder;
use Symfony\Component\HttpFoundation\Response;

class ResponseFactory implements ResponseFactoryInterface
{
    private $serializer;

    private function getSerializer()
    {
        if (null === $this->serializer) {
            $this->serializer = SerializerBuilder::create()->build();
        }

        return $this->serializer;
    }

    /**
     * @param mixed $data
     * @return Response
     */
    public function createDataResponse($data) {
        $jsonContent = (null === $data) ? '{}' : $this->getSerializer()->serialize($data, 'json');

        return Response::create($jsonContent, 200, ['Content-Type' => 'application/json']);
    }

    /**
     * @param string $err
     * @return Response
     */
    public function createErrorResponse($err)
    {
        $data = '{"status": "error", "message": "'.$err.'"}';

        return Response::create($data, 200, ['Content-Type', 'application/json']);
    }

    /**
     * @return Response
     */
    public function createSuccessResponse()
    {
        $data = '{"status": "success"}';

        return Response::create($data, 200, ['Content-Type', 'application/json']);
    }
}