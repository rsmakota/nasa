<?php
/**
 * @author    Rodion Smakota <rsmakota@svitla.com>
 * @copyright 2018 Svitla LTD
 */

namespace NasaBundle\Service;


use NasaBundle\Entity\Category;
use NasaBundle\Entity\Post;
use NasaBundle\Filter\FilterInterface;
use NasaBundle\Filter\PostFilter;
use NasaBundle\ORM\PostRepository;
use NasaBundle\Validate\ArrayValidatorInterface;
use Doctrine\ORM\EntityManagerInterface;

class PostService
{
    private $manager;
    private $categoryService;
    private $validator;

    /**
     * PostService constructor.
     * @param EntityManagerInterface $manager
     * @param CategoryService $service
     * @param ArrayValidatorInterface $validator
     */
    public function __construct(EntityManagerInterface $manager, CategoryService $service, ArrayValidatorInterface $validator)
    {
        $this->manager = $manager;
        $this->categoryService = $service;
        $this->validator = $validator;
    }

    /**
     * @param integer $id
     *
     * @return Post|null
     */
    public function find($id)
    {
        return $this->manager->getRepository(Post::class)->find($id);
    }

    public function findAll(PostFilter $filter)
    {
        /** @var PostRepository $repository */
        $repository = $this->manager->getRepository(Post::class);

        return $repository->findByFilter($filter);
    }

    /**
     * @param array $data
     * @param array $fields
     * @throws \Exception
     */
    private function validate($data, $fields)
    {
        $this->validator->validateExist($data, $fields);
        $this->validator->validateEmpty($data, $fields);
    }

    /**
     * @param integer $id
     * @return \NasaBundle\Entity\Category|null
     * @throws \Exception
     */
    private function getCategory($id)
    {
        $category = $this->categoryService->find($id);
        if (!($category instanceof Category)) {
            throw new \Exception('Can\'t find category with id '.$id);
        }

        return $category;
    }

    /**
     * @param $id
     * @return Post
     * @throws \Exception
     */
    private function getPost($id) {
        $entity =  $this->find($id);
        if (!($entity instanceof Post)) {
            throw new \Exception('Can\'t find post with id '.$id);
        }

        return $entity;
    }

    /**
     * @param array $data
     * @return Post
     * @throws \Exception
     */
    public function create($data)
    {
        $this->validate($data, ['author', 'categoryId', 'text']);

        $category = $this->getCategory($data['categoryId']);
        $entity =  new Post();
        $entity->setAuthor($data['author']);
        $entity->setCategory($category);
        $entity->setText($data['text']);

        $this->manager->persist($entity);
        $this->manager->flush();

        return $entity;
    }

    /**
     * @param integer $id
     * @param array $data
     * @return Post
     * @throws \Exception
     */
    public function update($id, $data)
    {
        $this->validate($data, ['author', 'categoryId', 'text']);
        $category = $this->getCategory($data['categoryId']);
        $entity =  $this->getPost($id);

        $entity->setAuthor($data['author']);
        $entity->setCategory($category);
        $entity->setText($data['text']);

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
        $entity =  $this->getPost($id);

        $this->manager->remove($entity);
        $this->manager->flush();
    }



}