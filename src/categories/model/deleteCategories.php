<?php 

    include('../../database/connection.php');
    include('../../database/config.php');
    if($conn){  

        $requestData = $_REQUEST;

        $id = isset($requestData['idcategoria']) ? $requestData : '';

        $sql = "DELETE FROM categorias WHERE idcategoria = $id ";

        $resultado = mysqli_query($conn, $sql);

        if($resultado){
            $dados = array(
                "tipo" => TYPE_MSG_SUCCESS,
                "mensagem" => "Deletado com sucesso"
            );
        }else{
            $dados = array(
                "tipo" => TYPE_MSG_ERROR,
                "mensagem" => "Não deletou"
            );
        }

        mysqli_close($conn);

    }else{
        $dados = array(
            "tipo" => TYPE_MSG_ERROR,
            "mensagem" => "Nao conectou ao banco"
        );
    }

    echo json_encode($dados, JSON_UNESCAPED_SLASHES, JSON_UNESCAPED_UNICODE);