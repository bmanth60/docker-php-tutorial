<?php

class Entity {
    protected $_password;
    protected $_displayName;
    protected $_userName;

    function getPassword(): string {
        return $this->_password;
    }

    function setPassword(string $password): Entity {
        $this->_password = $password;
        return $this;
    }

    function getDisplayName(): string {
        return $this->_displayName;
    }

    function setDisplayName(string $displayName): Entity {
        $this->_displayName = $displayName;
        return $this;
    }

    function getUserName(): string {
        return $this->userName;
    }

    function setUserName(string $userName): Entity {
        $this->_userName = $userName;
        return $this;
    }
}