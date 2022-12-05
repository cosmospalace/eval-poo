<?php

class Game {
    private $id;
    private $title;
    private $minPlayer;
    private $maxPlayer;
    private $erreurs = [];

    const TITLE_INVALIDE = 1;
    const MINPLAYER_INVALIDE = 2;
    const MAXPLAYER_INVALIDE = 3;

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

    public function setTitle($title) {
        if (!empty($title) && is_string($title)) {
            $this->title = $title;
        } else {
            $this->erreurs[] = self::TITLE_INVALIDE;
        }
    }

    public function setMinPlayer($minPlayer) {
        if (is_int($minPlayer)) {
            $this->minPlayer = $minPlayer;
        } else {
            $this->erreurs[] = self::MINPLAYER_INVALIDE;
        }
    }

    public function setMaxPlayer($maxPlayer) {
        if (is_int($maxPlayer)) {
            $this->maxPlayer = $maxPlayer;
        } else {
            $this->erreurs[] = self::MAXPLAYER_INVALIDE;
        }
    }

    public function getId() {
        return $this->id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getMinPlayer() {
        return $this->minPlayer;
    }

    public function getMaxPlayer() {
        return $this->maxPlayer;
    }

    public function getErreurs() {
        return $this->erreurs;
    }

    public function isGameValid() {
        return !(empty($this->title) || empty($this->minPlayer) || empty($this->maxPlayer));
    }
}