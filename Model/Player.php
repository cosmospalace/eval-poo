<?php

class Player {
    private $id;
    private $nickname;
    private $email;
    private $erreurs = [];

    const NICKNAME_INVALIDE = 1;
    const EMAIL_INVALIDE = 2;

    public function __construct($data) {
        $this->assignement($data);
    }

public function assignement($data) {
    foreach ($data as $key => $value) {
        $method = 'set' . ucfirst($key);
        if (method_exists($this, $method)) {
            $this->$method($value);
        }
    }
}

public function setId($id) {
    $this->id = (int) $id;

}

public function setNickname($nickname) {
    if (!empty($nickname) && is_string($nickname)) {
        $this->nickname = $nickname;
    } else {
        $this->erreurs[] = self::NICKNAME_INVALIDE;
    }
}

public function setEmail($email) {
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $this->email = $email;
    } else {
        $this->erreurs[] = self::EMAIL_INVALIDE;
    }
}

public function getId() {
    return $this->id;
}

public function getNickname() {
    return $this->nickname;
}

public function getEmail() {
    return $this->email;
}

public function getErreurs() {
    return $this->erreurs;
}

public function isValid() {
    return !empty($this->nom) || empty($this->prenom) || empty($this->email);
}

}

