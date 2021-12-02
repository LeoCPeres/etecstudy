<?php

include_once './class/Conectar.php';
include_once './class/Controles.php';

class Salvos
{
    private $id_salvo;
    private $url;
    private $id_usuario;
    private $con;

    function getIdSalvo()
    {
        return $this->id_salvo;
    }

    function getUrl()
    {
        return $this->url;
    }

    function getIdUsuario()
    {
        return $this->id_usuario;
    }

    function setIdSalvo($id_salvo)
    {
        $this->id_salvo = $id_salvo;
    }

    function setUrl($url)
    {
        $this->url = $url;
    }

    function setIdUsuario($id_usuario)
    {
        $this->id_usuario = $id_usuario;
    }

    function salvarSalvos()
    {
        try {
            $this->con = new Conectar();

            $sql = "INSERT INTO salvos VALUES (null, ?, ?)";

            $executar = $this->con->prepare($sql);

            $executar->bindValue(1, $this->url);
            $executar->bindValue(2, $this->id_usuario);

            if ($executar->execute() == 1) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    function consultarSalvos()
    {
        try {
            $this->con = new Conectar();
            $sql = "SELECT * FROM salvos inner join materia ON materia.url = salvos.url where id_usuario = ? order by id_salvo DESC";
            $executar = $this->con->prepare($sql);

            $executar->bindValue(1, $this->id_usuario);


            if ($executar->execute() == 1) {
                return $executar->fetchAll();
            } else {
                return false;
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    function consultarSalvosTop4()
    {
        try {
            $this->con = new Conectar();
            $sql = "SELECT * FROM salvos inner join materia ON materia.url = salvos.url where id_usuario = ? order by id_salvo DESC limit 4 ";
            $executar = $this->con->prepare($sql);

            $executar->bindValue(1, $this->id_usuario);


            if ($executar->execute() == 1) {
                return $executar->fetchAll();
            } else {
                return false;
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    function consultarPaginaSalva()
    {
        try {
            $this->con = new Conectar();
            $sql = "SELECT * FROM salvos inner join materia ON materia.url = salvos.url where id_usuario = ? and salvos.url = ?";
            $executar = $this->con->prepare($sql);

            $executar->bindValue(1, $this->id_usuario);
            $executar->bindValue(2, $this->url);


            if ($executar->execute() == 1) {
                return $executar->fetchAll();
            } else {
                return false;
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    function deletarSalvo()
    {
        try {
            $this->con = new Conectar();

            $sql = "DELETE FROM salvos WHERE url = ?";

            $executar = $this->con->prepare($sql);
            $executar->bindValue(1, $this->url);


            if ($executar->execute() == 1) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }
}