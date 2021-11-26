<?php

include_once('Conectar.php');
include_once('Controles.php');

class Disciplina
{

    private $disciplina;
    private $id_disc;
    private $con;

    function getDisciplina()
    {
        return $this->disciplina;
    }
    function setDisciplina($disciplina)
    {
        $this->disciplina = $disciplina;
    }
    function getIdDisciplina()
    {
        return $this->id_disc;
    }
    function setIdDisciplina($id_disc)
    {
        $this->id_disc = $id_disc;
    }

    function ConsultarTodasDisciplinas()
    {
        try {
            $this->con = new Conectar();
            $sql = "SELECT * FROM disciplinas";
            $executar = $this->con->prepare($sql);


            if ($executar->execute() == 1) {
                return $executar->fetchAll();
            } else {
                return false;
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    function cadastrarNovaDisciplina()
    {
        try {
            $this->con = new Conectar();
            $sql = "INSERT INTO disciplinas VALUES (null, ?)";

            $executar = $this->con->prepare($sql);

            $executar->bindValue(1, $this->disciplina);

            if ($executar->execute() == 1) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    function excluirDisc()
    {
        try {
            $this->con = new Conectar();

            $sql = "DELETE FROM disciplinas WHERE id_disc = ?";

            $executar = $this->con->prepare($sql);
            $executar->bindValue(1, $this->id_disc);


            if ($executar->execute() == 1) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    function ConsultarPorId($id)
    {
        try {
            $this->con = new Conectar();
            $sql = "SELECT * FROM disciplinas WHERE id_disc = ?";
            $executar = $this->con->prepare($sql);
            $executar->bindValue(1, $id);

            if ($executar->execute() == 1) {
                return $executar->fetchAll();
            } else {
                return false;
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }
}