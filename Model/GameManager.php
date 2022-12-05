<?php

class UserManager
{
    private $dataBase;

    public function __construct(PDO $dataBase)
    {
        $this->dataBase = $dataBase;
    }

    public function insertGame(Game $game)
    {
        $req = $this->dataBase->prepare("INSERT INTO game(title, min_player, max_player) VALUES(:title, :min_player, :max_player)");

        $req->bindValue(':title', $game->getTitle(), PDO::PARAM_STR);
        $req->bindValue(':min_player', $game->getMinPlayer());
        $req->bindValue(':max_player', $game->getMaxPlayer());

        $req->execute();
    }

    public function getAllGame()
    {
        $req = $this->dataBase->prepare("SELECT * FROM game");

        $req->execute();

        $games = [];

        while ($data = $req->fetch(PDO::FETCH_ASSOC)) {
            $games[] = new Game($data);
        }

        return $games;
    }

    public function getGameById($id)
    {
        $req = $this->dataBase->prepare("SELECT * FROM game WHERE id = :id");

        $req->bindValue(':id', $id);
        $req->execute();

        $data = $req->fetch(PDO::FETCH_ASSOC);

        return new Game($data);
    }

    public function updateGame(Game $game)
    {
        $req = $this->dataBase->prepare("UPDATE game SET title = :title, min_player = :min_player, max_player = :max_player WHERE id = :id");

        $req->bindValue(':title', $game->getTitle(), PDO::PARAM_STR);
        $req->bindValue(':min_player', $game->getMinPlayer());
        $req->bindValue(':max_player', $game->getMaxPlayer());
        $req->bindValue(':id', $game->getId());

        $req->execute();
    }

    public function deleteGame($id)
    {
        $req = $this->dataBase->prepare("DELETE FROM game WHERE id = :id");

        $req->bindValue(':id', $id);
        $req->execute();
    }
}