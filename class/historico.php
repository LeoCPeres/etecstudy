<?php

include_once('Conectar.php');
include_once('Controles.php');

class Historico
{

    private $id_hist;
    private $url;
    private $id_usuario;
    private $urlAnterior;
    private $acesso;
    private $con;

    function getIdHist()
    {
        return $this->id_hist;
    }

    function getAcesso()
    {
        return $this->acesso;
    }

    function getUrl()
    {
        return $this->url;
    }

    function getUrlAnterior()
    {
        return $this->urlAnterior;
    }

    function getIdUsuario()
    {
        return $this->id_usuario;
    }

    function setIdHist($id_hist)
    {
        $this->id_hist = $id_hist;
    }

    function setUrl($url)
    {
        $this->url = $url;
    }

    function setIdUsuario($id_usuario)
    {
        $this->id_usuario = $id_usuario;
    }

    function setUrlAnterior($urlAnterior)
    {
        $this->urlAnterior = $urlAnterior;
    }

    function setAcesso($acesso)
    {
        $this->acesso = $acesso;
    }

    function salvarHistorico()
    {
        try {
            $this->con = new Conectar();

            $sql = "INSERT INTO historico VALUES (null, ?, ?, ?)";

            $executar = $this->con->prepare($sql);

            $executar->bindValue(1, $this->url);
            $executar->bindValue(2, $this->id_usuario);
            $executar->bindValue(3, $this->acesso);

            if ($executar->execute() == 1) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    function editarHistorico()
    {
        try {
            $this->con = new Conectar();
            $this->ct = new Controles();

            $sql = "UPDATE historico SET url = ?, acesso = ? where url = ?";

            $executar = $this->con->prepare($sql);

            $executar->bindValue(1, $this->ct->montarUrl($this->url));
            $executar->bindValue(2, $this->acesso);
            $executar->bindValue(3, $this->urlAnterior);

            if ($executar->execute() == 1) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    function consultarHistorico()
    {
        try {
            $this->con = new Conectar();
            $sql = "SELECT * FROM historico inner join materia ON materia.url = historico.url where id_usuario = ? order by id_hist DESC";
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
    function consultarHistoricoTop4()
    {
        try {
            $this->con = new Conectar();
            $sql = "SELECT * FROM historico inner join materia ON materia.url = historico.url where id_usuario = ? order by id_hist DESC limit 4 ";
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

    function deletarHistorico()
    {
        try {
            $this->con = new Conectar();

            $sql = "DELETE FROM historico WHERE url = ?";

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

    function deletarHistoricoUsuario()
    {
        try {
            $this->con = new Conectar();

            $sql = "DELETE FROM historico WHERE id_hist = ?";

            $executar = $this->con->prepare($sql);
            $executar->bindValue(1, $this->id_hist);


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