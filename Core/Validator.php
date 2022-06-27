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
        $regexp = "/^[a-zA-Z][a-zA-Z0-9-_\.]{1,20}$/";
        return preg_match($regexp, $name);
    }

}