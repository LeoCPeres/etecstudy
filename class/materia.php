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
    private $id_disc;
    private $visitas;
    private $url;
    private $materia;
    private $verificado;
    private $idVerificado;
    private $imagem;
    private $temp_imagem;
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
    function getImagem()
    {
        return $this->imagem;
    }
    function getTempImagem()
    {
        return $this->temp_imagem;
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
    function getId_Disc()
    {
        return $this->id_disc;
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
    function setImagem($imagem)
    {
        $this->imagem = $imagem;
    }
    function setTempImagem($temp_imagem)
    {
        $this->temp_imagem = $temp_imagem;
    }
    function setDisciplina($disciplina)
    {
        $this->disciplina = $disciplina;
    }
    function setVisitas($visitas)
    {
        $this->visitas = $visitas;
    }
    function setId_Disc($id_disc)
    {
        $this->id_disc = $id_disc;
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

            $sql = "INSERT INTO materia VALUES (null, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

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
            $executar->bindValue(10, $this->imagem);
            $executar->bindValue(11, $this->temp_imagem);

            if ($executar->execute() == 1) {
                $this->ct->enviarArquivo($this->temp_imagem, "../img/capas/" . $this->imagem, $this->imagem);
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

    function ConsultarTop4()
    {
        try {
            $this->con = new Conectar();
            $sql = "SELECT * FROM materia order by id_materia DESC limit 4 ";
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
                idVerificado = ?,
                imagem = ?,
                temp_imagem = ? 
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
            $executar->bindValue(12, $this->id_materia);
            $executar->bindValue(10, $this->imagem);
            $executar->bindValue(11, $this->temp_imagem);

            if ($executar->execute() == 1) {
                $this->ct->enviarArquivo($this->temp_imagem, "../img/capas/" . $this->imagem, $this->imagem);
                return true;
            } else {
                return false;
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }
}