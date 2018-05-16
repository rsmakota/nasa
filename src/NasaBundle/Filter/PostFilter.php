<?php
/**
 * @author    Rodion Smakota <rsmakota@svitla.com>
 * @copyright 2018 Svitla LTD
 */

namespace NasaBundle\Filter;


class PostFilter implements FilterInterface
{
    private $from;
    private $to;
    private $author;
    private $categories;

    /**
     * @param array $params
     * @return PostFilter
     */
    public static function create($params)
    {
        $filter = new self();
        if (!is_array($params)) {
            return $filter;
        }
        $filter->from = isset($params['from']) ? new \DateTime($params['from']) : null;
        $filter->to = isset($params['to']) ? new \DateTime($params['to']) : null;
        $filter->author = isset($params['author']) ? $params['author'] : null;
        $filter->categories = isset($params['categories']) ? explode(',', $params['categories']) : null;

        return $filter;
    }

    /**
     * @return \DateTime|null
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * @return \DateTime|null
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @return array|null
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * @return boolean
     */
    public function hasFrom()
    {
        return null !== $this->from;
    }

    /**
     * @return boolean
     */
    public function hasTo()
    {
        return null !== $this->to;
    }

    /**
     * @return string
     */
    public function hasAuthor()
    {
        return null !== $this->author;
    }

    /**
     * @return boolean
     */
    public function hasCategories()
    {
        return null !== $this->categories;
    }

}