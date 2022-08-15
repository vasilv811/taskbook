<?php


namespace Core;


class Validator
{
    /**
     * @param string $email
     * @return bool
     */
    public function isValidEmail(string $email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    /**
     * @param $name
     * @return bool
     */
    public function isValidName($name): bool
    {
        $regexp = "/[A-Za-zА-Яа-яЁё]{2,}/";
        return preg_match($regexp, $name);
    }

    public function isValidStatus($status): bool
    {
       return $status === 'nonFinished' || $status === 'finished';
    }

}