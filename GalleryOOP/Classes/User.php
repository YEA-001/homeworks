<?php

/**
 * Created by PhpStorm.
 * User: Y
 * Date: 4/29/2016
 * Time: 4:07 PM
 */
class User
{
    private $credentialsArray = array();
    private $fileWithCredentialsName;
    public function __construct($fileName)
    {
        $this->fileWithCredentialsName = $fileName;

        // read credentials from file
        if (file_exists($this->fileWithCredentialsName)) {
            $this->credentialsArray = unserialize(file_get_contents($this->fileWithCredentialsName));
        } else {
            file_put_contents($this->fileWithCredentialsName, serialize($this->credentialsArray));
        }
    }

    private function IsCredentialsValid($login, $password)
    {
        if (isset($this->credentialsArray[$login]) && $this->credentialsArray[$login] === $password)
            return true;

        return false;
    }

    public function login($login, $password)
    {
        if ($this->IsCredentialsValid($login, $password)) {
            $_SESSION['session'] = true;
            $_SESSION['name'] = $login;
            return true;
        }

        return false;
    }

    public function add($login, $password)
    {
        if (isset($this->credentialsArray[$login]))
            return false;

        // add new credentials
        $this->credentialsArray[$login] = $password;
        file_put_contents($this->fileWithCredentialsName, serialize($this->credentialsArray), LOCK_EX);
        
        // login with new credentials
        $this->login($login, $password);
        
        return true;
    }
}