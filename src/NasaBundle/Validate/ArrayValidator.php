<?php
/**
 * @author    Rodion Smakota <rsmakota@svitla.com>
 * @copyright 2018 Svitla LTD
 */

namespace NasaBundle\Validate;


class ArrayValidator implements ArrayValidatorInterface
{
    const ERR_MESS_NOT_ARRAY = 'Data is not an array';
    const ERR_MESS_ABSENT_PARAM = 'Required param <<%s>> is absent';
    const ERR_MESS_EMPTY_PARAM = 'Required param <<%s>> is empty';

    /**
     * @param array $data
     * @param array $fields
     * @throws \Exception
     */
    public function validateExist($data, array $fields)
    {
        if (!is_array($data)) {
            throw new \Exception(self::ERR_MESS_NOT_ARRAY);
        }
        foreach ($fields as $field) {
            if (!array_key_exists($field, $data)) {
                throw new \Exception(printf(self::ERR_MESS_ABSENT_PARAM, $field));
            }
        }
    }

    /**
     * @param array $data
     * @param array $fields
     * @throws \Exception
     */
    public function validateEmpty($data, array $fields)
    {
        if (!is_array($data)) {
            throw new \Exception(self::ERR_MESS_NOT_ARRAY);
        }
        foreach ($fields as $field) {
            $val = $data[$field];
            if (empty($val)) {
                throw new \Exception(printf(self::ERR_MESS_EMPTY_PARAM, $field));
            }
        }
    }


}