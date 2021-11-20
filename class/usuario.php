<?php

include_once('Conectar.php');

class Usuario
{
    private $id_usuario;
    private $email;
    private $nome;
    private $sobrenome;
    private $telefone;
    private $escolaridade;
    private $senha;
    private $admin;
    private $estudante_etec;
    private $id_professor;
    private $nascimento;
    private $con;

    function getId()
    {
        return $this->id_usuario;
    }

    function getEmail()
    {
        return $this->email;
    }

    function getNome()
    {
        return $this->nome;
    }

    function getSobrenome()
    {
        return $this->sobrenome;
    }

    function getTelefone()
    {
        return $this->telefone;
    }

    function getEscolaridade()
    {
        return $this->escolaridade;
    }

    function getSenha()
    {
        return $this->senha;
    }

    function getNascimento()
    {
        return $this->nascimento;
    }

    function getAdmin()
    {
        return $this->admin;
    }

    function getEstudante()
    {
        return $this->estudante_etec;
    }

    function getIdProfessor()
    {
        return $this->id_professor;
    }

    function setId($id_usuario)
    {
        $this->id_usuario = $id_usuario;
    }

    function setNascimento($nascimento)
    {
        $this->nascimento = $nascimento;
    }

    function setEmail($email)
    {
        $this->email = $email;
    }

    function setNome($nome)
    {
        $this->nome = $nome;
    }
    function setSobrenome($sobrenome)
    {
        $this->sobrenome = $sobrenome;
    }

    function setTelefone($telefone)
    {
        $this->telefone = $telefone;
    }

    function setEscolaridade($escolaridade)
    {
        $this->escolaridade = $escolaridade;
    }

    function setSenha($senha)
    {
        $this->senha = $senha;
    }

    function setAdmin($admin)
    {
        $this->admin = $admin;
    }

    function setEstudante($estudante_etec)
    {
        $this->estudante_etec = $estudante_etec;
    }

    function setIdProfessor($id_professor)
    {
        $this->id_professor = $id_professor;
    }

    function GeraIdProfessor($int)
    {
        $idProfessor = 0;

        if ($int) {
            return $idProfessor = rand(1, 1000);
        } else {
            return $idProfessor;
        }
    }

    function salvar()
    {
        try {
            $this->con = new Conectar();

            $verificaUsuarioExistente = count($this->verificaUsuarioExistente());

            if ($verificaUsuarioExistente >= 1) {
                return false;
            }

            $sql = "INSERT INTO usuario VALUES (null, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            $executar = $this->con->prepare($sql);


            $executar->bindValue(1, $this->email);
            $executar->bindValue(2, $this->nome);
            $executar->bindValue(3, $this->sobrenome);
            $executar->bindValue(4, trim($this->telefone));
            $executar->bindValue(5, $this->escolaridade);
            $executar->bindValue(6, trim(md5($this->senha)));
            $executar->bindValue(7, $this->admin);
            $executar->bindValue(8, $this->estudante_etec);
            $executar->bindValue(9, $this->id_professor);
            $executar->bindValue(10, $this->nascimento);


            if ($executar->execute() == 1) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    function verificaUsuarioExistente()
    {
        try {
            $this->con = new Conectar();

            $sql = "SELECT * FROM usuario WHERE email = ?";

            $executar = $this->con->prepare($sql);

            $executar->bindValue(1, $this->email);

            if ($executar->execute() == 1) {
                return $executar->fetchAll();
            } else {
                return false;
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    function consultar()
    {
        try {
            $this->con = new Conectar();

            if ($this->email != "") {
                $sql = "SELECT id_usuario, email, senha from usuario where email = ? and senha = ?";

                $executar = $this->con->prepare($sql);

                $executar->bindValue(1, $this->email);
                $executar->bindValue(2, md5($this->senha));
            }

            if ($executar->execute() == 1) {
                return $executar->fetchColumn();
            } else {
                return false;
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }
}
