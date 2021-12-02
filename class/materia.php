<?php

include_once('Conectar.php');
include_once('Controles.php');
include_once('Historico.php');

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
    private $id_usuario;
    private $imagem;
    private $temp_imagem;
    private $pdf;
    private $temp_pdf;
    private $con;
    private $hist;

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
    function getUsuario()
    {
        return $this->id_usuario;
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
    function getPDF()
    {
        return $this->pdf;
    }
    function getTempPDF()
    {
        return $this->temp_pdf;
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
    function setPDF($pdf)
    {
        $this->pdf = $pdf;
    }
    function setTempPDF($temp_pdf)
    {
        $this->temp_pdf = $temp_pdf;
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
    function setIdUsuario($id_usuario)
    {
        $this->id_usuario = $id_usuario;
    }


    function salvar()
    {
        try {
            $this->con = new Conectar();
            $this->ct = new Controles();

            $sql = "INSERT INTO materia VALUES (null, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            $executar = $this->con->prepare($sql);

            $executar->bindValue(1, $this->titulo);
            $executar->bindValue(2, $this->descricao);
            $executar->bindValue(3, $this->data);
            $executar->bindValue(4, $this->ct->montarUrl($this->titulo));
            $executar->bindValue(5, $this->disciplina);
            $executar->bindValue(6, $this->visitas);
            $executar->bindValue(7, $this->materia);
            $executar->bindValue(8, $this->imagem);
            $executar->bindValue(9, $this->temp_imagem);
            $executar->bindValue(10, $this->id_usuario);
            $executar->bindValue(11, $this->pdf);
            $executar->bindValue(12, $this->temp_pdf);


            if ($executar->execute() == 1) {
                $this->ct->enviarArquivo($this->temp_imagem, "../img/capas/" . $this->imagem, $this->imagem);
                $this->ct->enviarArquivo($this->temp_pdf, "../img/pdf/" . $this->pdf, $this->pdf);
                return true;
            } else {
                return false;
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    function atualizaVisitas()
    {
        try {
            $this->con = new Conectar();

            $sql = "UPDATE materia SET visitas = ? WHERE id_materia = ?";

            $executar = $this->con->prepare($sql);

            $executar->bindValue(1, $this->visitas);
            $executar->bindValue(2, $this->id_materia);

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
            $sql = "SELECT * FROM materia inner join disciplinas ON disciplinas.id_disc = materia.id_disc WHERE id_materia = ? ";
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
            $sql = "SELECT * FROM materia inner join disciplinas ON disciplinas.id_disc = materia.id_disc WHERE titulo LIKE ? ";
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

    function ConsultarPorDisc($id_disc)
    {
        try {
            $this->con = new Conectar();
            $sql = "SELECT * FROM materia inner join disciplinas ON disciplinas.id_disc = materia.id_disc WHERE disciplinas.id_disc = ? ";
            $executar = $this->con->prepare($sql);
            $executar->bindValue(1, $id_disc);


            if ($executar->execute() == 1) {
                return $executar->fetchAll();
            } else {
                return false;
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    function ConsultarPorUrl($url)
    {
        try {
            $this->con = new Conectar();
            $sql = "SELECT * FROM materia join disciplinas ON disciplinas.id_disc = materia.id_disc inner join usuario ON usuario.id_usuario = materia.id_usuario_inclusao  WHERE url = ?";
            $executar = $this->con->prepare($sql);
            $executar->bindValue(1, $url);


            if ($executar->execute() == 1) {
                return $executar->fetchAll();
            } else {
                return $executar->fetchAll();
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    function ConsultarPorProfessor($id_professor)
    {
        try {
            $this->con = new Conectar();
            $sql = "SELECT * FROM materia WHERE id_usuario_inclusao = ?";
            $executar = $this->con->prepare($sql);
            $executar->bindValue(1, $id_professor);


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
            $sql = "SELECT * FROM materia inner join disciplinas ON disciplinas.id_disc = materia.id_disc";
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
            $sql = "SELECT * FROM materia inner join disciplinas ON disciplinas.id_disc = materia.id_disc order by id_materia DESC limit 4 ";
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
            $this->hist = new Historico();

            $sql =
                "UPDATE materia SET 
                titulo = ?, 
                descricao = ?, 
                data = ?, 
                url = ?, 
                id_disc = ?,  
                materia = ?, 
                imagem = ?,
                temp_imagem = ?,
                id_usuario_inclusao = ?
            WHERE id_materia = ?";

            $executar = $this->con->prepare($sql);

            $executar->bindValue(1, $this->titulo);
            $executar->bindValue(2, $this->descricao);
            $executar->bindValue(3, $this->data);
            $executar->bindValue(4, $this->ct->montarUrl($this->titulo));
            $executar->bindValue(5, $this->disciplina);
            $executar->bindValue(6, $this->materia);
            $executar->bindValue(10, $this->id_materia);
            $executar->bindValue(7, $this->imagem);
            $executar->bindValue(8, $this->temp_imagem);
            $executar->bindValue(9, $this->id_usuario);


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