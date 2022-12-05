<?php

class PlayerManager
{
    private $dataBase;

    public function __construct(PDO $dataBase)
    {
        $this->dataBase = $dataBase;
    }

    public function insertPlayer(Player $player)
    {
        $req = $this->dataBase->prepare("INSERT INTO player(nickname, email) VALUES(:nickname, :email)");

        $req->bindValue(':nickname', $player->getNickname(), PDO::PARAM_STR);
        $req->bindValue(':email', $player->getEmail());

        $req->execute();
    }

    public function getAllPlayer()
    {
        $req = $this->dataBase->prepare("SELECT * FROM player");

        $req->execute();

        $players = [];

        while ($data = $req->fetch(PDO::FETCH_ASSOC)) {
            $players[] = new Player($data);
        }

        return $players;
    }

    public function getUserById($id)
    {
        $req = $this->dataBase->prepare("SELECT * FROM player WHERE id = :id");

        $req->bindValue(':id', $id);
        $req->execute();

        $data = $req->fetch(PDO::FETCH_ASSOC);

        return new Player($data);
    }

    public function updatePlayer(Player $player)
    {
        $req = $this->dataBase->prepare("UPDATE player SET nickname = :nickname, email = :email WHERE id = :id");

        $req->bindValue(':nickname', $player->getNickname(), PDO::PARAM_STR);
        $req->bindValue(':email', $player->getEmail());
        $req->bindValue(':id', $player->getId());

        $req->execute();
    }

    public function deleteUser($id)
    {
        $req = $this->dataBase->prepare("DELETE FROM player WHERE id = :id");
        $req->bindValue(':id', $id);
        $req->execute();
    }

}