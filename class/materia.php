<?php

include_once('Conectar.php');
include_once('Controles.php');

class Materia
{
    private $id_materia;
    private $titulo;
    private $descricao;
    private $data;
    private $disciplina;
    private $visitas;
    private $url;
    private $materia;
    private $verificado;
    private $idVerificado;
    private $con;

    function getId_Materia()
    {
        return $this->id_materia;
    }
    function getTitulo()
    {
        return $this->titulo;
    }
    function getDescricao()
    {
        return $this->descricao;
    }
    function getData()
    {
        return $this->data;
    }
    function getDisciplina()
    {
        return $this->disciplina;
    }
    function getVisitas()
    {
        return $this->visitas;
    }
    function getMateria()
    {
        return $this->materia;
    }
    function getUrl()
    {
        return $this->url;
    }
    function getVerificado()
    {
        return $this->verificado;
    }
    function getIdVerificado()
    {
        return $this->idVerificado;
    }

    function setId_Materia($id_materia)
    {
        $this->id_materia = $id_materia;
    }
    function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }
    function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }
    function setData($data)
    {
        $this->data = $data;
    }
    function setDisciplina($disciplina)
    {
        $this->disciplina = $disciplina;
    }
    function setVisitas($visitas)
    {
        $this->visitas = $visitas;
    }
    function setMateria($materia)
    {
        $this->materia = $materia;
    }
    function setUrl($url)
    {
        $this->url = $url;
    }
    function setVerificado($verificado)
    {
        $this->verificado = $verificado;
    }
    function setIdVerificado($idVerificado)
    {
        $this->idVerificado = $idVerificado;
    }

    function salvar()
    {
        try {
            $this->con = new Conectar();
            $this->ct = new Controles();

            $sql = "INSERT INTO materia VALUES (null, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            $executar = $this->con->prepare($sql);



            $executar->bindValue(1, $this->titulo);
            $executar->bindValue(2, $this->descricao);
            $executar->bindValue(3, $this->data);
            $executar->bindValue(4, $this->ct->montarUrl($this->titulo, $this->id_materia));
            $executar->bindValue(5, $this->disciplina);
            $executar->bindValue(6, $this->visitas);
            $executar->bindValue(7, $this->verificado);
            $executar->bindValue(8, $this->materia);
            $executar->bindValue(9, $this->idVerificado);

            if ($executar->execute() == 1) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    function ConsultarPorId($id_materia)
    {
        try {
            $this->con = new Conectar();
            $sql = "SELECT * FROM materia WHERE id_materia = ?";
            $executar = $this->con->prepare($sql);
            $executar->bindValue(1, $id_materia);

            if ($executar->execute() == 1) {
                return $executar->fetchAll();
            } else {
                return false;
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    function ConsultarPorTitulo($titulo)
    {
        try {
            $this->con = new Conectar();
            $sql = "SELECT * FROM materia WHERE titulo = ? ";
            $executar = $this->con->prepare($sql);
            $executar->bindValue(1, $titulo);


            if ($executar->execute() == 1) {
                return $executar->fetchAll();
            } else {
                return false;
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    function ConsultarTodos()
    {
        try {
            $this->con = new Conectar();
            $sql = "SELECT * FROM materia";
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

    function editar()
    {
        try {
            $this->con = new Conectar();
            $this->ct = new Controles();

            $sql =
                "UPDATE materia SET 
                titulo = ?, 
                descricao = ?, 
                data = ?, 
                url = ?, 
                disciplina = ?, 
                visitas = ?, 
                verificado = ?, 
                materia = ?, 
                idVerificado = ? 
            WHERE id_materia = ?";

            $executar = $this->con->prepare($sql);

            $executar->bindValue(1, $this->titulo);
            $executar->bindValue(2, $this->descricao);
            $executar->bindValue(3, $this->data);
            $executar->bindValue(4, $this->ct->montarUrl($this->titulo, $this->id_materia));
            $executar->bindValue(5, $this->disciplina);
            $executar->bindValue(6, $this->visitas);
            $executar->bindValue(7, $this->verificado);
            $executar->bindValue(8, $this->materia);
            $executar->bindValue(9, $this->idVerificado);
            $executar->bindValue(10, $this->id_materia);

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
