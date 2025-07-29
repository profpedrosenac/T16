<?php

        $id = "";
        $data = "";
        $nome = "";
        $login = "";
        $senha = "";
        $funcao = "";
        $status = "";
        $obs = "";
        $foto = "";

    if (!$_POST) {
        return;
    }
    include_once('conexao.php');

    if (isset($_POST['pesquisar_id'])) {
        $id = $_POST['pesquisar_id'];
    }
    else
    {
        $id = $_POST['txtId'];
        $data = $_POST['txtDataCadastro'];
        $nome = $_POST['txtNome'];
        $login = $_POST['txtLogin'];
        $senha = $_POST['txtSenha'];
        $funcao = $_POST['txtFuncao'];
        $status = $_POST['txtStatus'];
        $obs = $_POST['txtObs'];
        $foto = $_FILES['txtFoto'];
    }
    
    $acao = $_POST['acao'];

    if ($acao == 'cadastrar') {
        try {
            $sql = $conn->prepare("
                insert into usuario
                (nome_usuario, login_usuario, senha_usuario, funcao_usuario, status_usuario, obs_usuario, foto_usuario)
                values
                (:nome_usuario, :login_usuario, :senha_usuario, :funcao_usuario, :status_usuario, :obs_usuario, :foto_usuario)
            ");

            $sql->execute(array(
                ':nome_usuario'=>$nome, 
                ':login_usuario'=>$login, 
                ':senha_usuario'=>$senha, 
                ':funcao_usuario'=>$funcao, 
                ':status_usuario'=>$status,
                ':obs_usuario'=>$obs,
                ':foto_usuario'=>$foto['name']
            ));

            if ($sql->rowCount() > 0) {
                echo '<p>Cadastro realizado com sucesso. Linhas afetadas.'.$sql->rowCount().'</p>';
                echo '<p>ID Gerado: '.$conn->lastInsertId().'</p>';

                $pasta_dir = 'imagem/'.$conn->lastInsertId().'/';

                if (!file_exists($pasta_dir)) {
                    mkdir($pasta_dir);
                }

                $nomeComplFoto = $pasta_dir.$foto['name'];

                move_uploaded_file($foto['tmp_name'],$nomeComplFoto);

            }
        } catch (PDOException $erro) {
            echo $erro->getMessage();
        }
    }
    elseif ($acao == 'alterar') {
        try {
            $sql = $conn->prepare("
                update usuario set
                    nome_usuario = :nome_usuario,
                    login_usuario = :login_usuario,
                    senha_usuario = :senha_usuario,
                    funcao_usuario = :funcao_usuario,
                    status_usuario = :status_usuario,
                    obs_usuario = :obs_usuario
                where id_usuario = :id_usuario
            ");

            $sql->execute(array(
                ':nome_usuario' => $nome,
                ':login_usuario' => $login,
                ':senha_usuario' => $senha,
                ':funcao_usuario' => $funcao,
                ':status_usuario' => $status,
                ':obs_usuario'=>$obs,
                ':id_usuario' => $id
            ));

            if ($sql->rowCount() > 0) {
                echo '<p>Alteração realizada com sucesso. Linhas afetadas: '.$sql->rowCount().'</p>';
            } else {
                echo '<p>Nenhuma linha foi alterada.</p>';
            }
        } catch (PDOException $erro) {
            echo $erro->getMessage();
        }
    }
    elseif ($acao == 'excluir') {
        try {
            $sql = $conn->prepare("delete from usuario where id_usuario = :id_usuario");

            $sql->execute(array(':id_usuario' => $id));

            if ($sql->rowCount() > 0) {
                echo '<p>Usuário excluído com sucesso. Linhas afetadas: '.$sql->rowCount().'</p>';
            } else {
                echo '<p>Nenhum usuário foi excluído.</p>';
            }
        } catch (PDOException $erro) {
            echo $erro->getMessage();
        }
    }
    elseif ($acao == 'pesquisar') {
        try {
            $sql = $conn->prepare("select * from usuario where id_usuario = :id_usuario");

            $sql->execute(array(':id_usuario' => $id));

            if ($sql->rowCount() > 0) {
                foreach ($sql as $row) {
                    // echo '<pre>';
                    // print_r($row);
                    // echo '</pre>';

                    // echo '<img src="imagem/'.$row[0].'/'.$row['foto_usuario'].'" alt="">';

                    $id = $row[0];
                    $data = $row[6];
                    $nome = $row[1];
                    $login = $row[2];
                    $senha = $row[3];
                    $funcao = $row[5];
                    $status = $row[8];
                    $obs = $row[7];
                    $foto = $row[4];

                }
            } else {
                echo '<p>Nenhum usuário encontrado com esse nome.</p>';
            }
        } catch (PDOException $erro) {
            echo $erro->getMessage();
        }
    }    
?>
