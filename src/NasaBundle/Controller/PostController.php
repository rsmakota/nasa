<?php

namespace NasaBundle\Controller;

use NasaBundle\Entity\Post;
use NasaBundle\Factory\ResponseFactoryInterface;
use NasaBundle\Filter\PostFilter;
use NasaBundle\Service\PostService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends Controller
{
    private $responseFactory;
    private $service;

    /**
     * PostController constructor.
     * @param ResponseFactoryInterface $responseFactory
     * @param PostService $service
     */
    public function __construct(ResponseFactoryInterface $responseFactory, PostService $service)
    {
        $this->responseFactory = $responseFactory;
        $this->service = $service;
    }

    /**
     * @Route("/post")
     * @Method("GET")
     * @param Request $request
     * @return Response
     */
    public function getAllAction(Request $request)
    {
        try {
            $filter = PostFilter::create($request->query->all());
            $posts = $this->service->findAll($filter);

            return $this->responseFactory->createDataResponse($posts);
        } catch (\Exception $e) {
            return $this->responseFactory->createErrorResponse($e->getMessage());
        }

    }

    /**
     * @Route("/post/{id}")
     * @Method("GET")
     * @param integer $id
     * @return Response
     */
    public function getAction($id)
    {
        try {
            $post = $this->service->find($id);

            return $this->responseFactory->createDataResponse($post);
        } catch (\Exception $e) {
            return $this->responseFactory->createErrorResponse($e->getMessage());
        }
    }

    /**
     * @Route("/post")
     * @Method("POST")
     * @param Request $request
     * @param \Swift_Mailer $mailer
     * @return Response
     */
    public function postAction(Request $request, \Swift_Mailer $mailer)
    {
        try {
            $json = $request->getContent();
            $data = json_decode($json, true);
            $entity = $this->service->create($data);
            $message = $this->createMail($entity);
            $mailer->send($message);

            return $this->responseFactory->createSuccessResponse();
        } catch (\Exception $e) {
            return $this->responseFactory->createErrorResponse($e->getMessage());
        }
    }

    /**
     * @Route("/post/{id}")
     * @Method("PUT")
     * @param Request $request
     * @param integer $id
     * @return Response
     */
    public function putAction(Request $request, $id)
    {
        try {
            $json = $request->getContent();
            $data = json_decode($json, true);
            $this->service->update($id, $data);

            return $this->responseFactory->createSuccessResponse();
        } catch (\Exception $e) {
            return $this->responseFactory->createErrorResponse($e->getMessage());
        }
    }

    /**
     * @Route("/post/{id}")
     * @Method("DELETE")
     * @param integer $id
     * @return Response
     */
    public function deleteAction($id)
    {
        try {
            $this->service->delete($id);

            return $this->responseFactory->createSuccessResponse();
        } catch (\Exception $e) {
            return $this->responseFactory->createErrorResponse($e->getMessage());
        }
    }

    /**
     * @param Post $entity
     * @return \Swift_Message
     */
    private function createMail($entity)
    {
        $str = '<h1> NEW POST <<'.$entity->getId().'>></h1><br>';
        $str .= '<h3>Author: '.$entity->getAuthor().'</h3><br>';
        $str .= '<strong> '.$entity->getCreated()->format('c').'</strong><br>';
        $str .= '<p>'.$entity->getText().'</p>';

        return (new \Swift_Message('New Post'))
            ->setFrom($this->getParameter('mailer_from'))
            ->setTo($this->getParameter('mailer_to'))
            ->setBody($str,'text/html');
    }


}
