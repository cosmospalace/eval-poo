<?php

class Contest
{
    private $id;
    private $game_id;
    private $start_date;
    private $winner_id;

    const GAME_ID_INVALIDE = 1;
    const START_DATE_INVALIDE = 2;
    const WINNER_ID_INVALIDE = 3;

    public function __construct($data)
    {
        $this->assignement($data);
    }

    public function assignement($data)
    {
        foreach ($data as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    public function setId($id)
    {
        $this->id = (int) $id;
    }

    public function setGameId($game_id)
    {
        if (is_int($game_id)) {
            $this->game_id = $game_id;
        } else {
            $this->erreurs[] = self::GAME_ID_INVALIDE;
        }
    }

    public function setStartDate($start_date)
    {
        if (is_string($start_date)) {
            $this->start_date = $start_date;
        } else {
            $this->erreurs[] = self::START_DATE_INVALIDE;
        }
    }

    public function setWinnerId($winner_id)
    {
        if (is_int($winner_id)) {
            $this->winner_id = $winner_id;
        } else {
            $this->erreurs[] = self::WINNER_ID_INVALIDE;
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function getGameId()
    {
        return $this->game_id;
    }

    public function getStartDate()
    {
        return $this->start_date;
    }

    public function getWinnerId()
    {
        return $this->winner_id;
    }

    public function getErreurs()
    {
        return $this->erreurs;
    }

    public function isValid()
    {
        return empty($this->erreurs);
    }
}