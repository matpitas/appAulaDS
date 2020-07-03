<?php

    include('../../database/connection.php');

    if($conn){

        $requestData = $_REQUEST;

        $id = isset($requestData['idcategoria']) ? $requestData['idcategoria'] : '';

        $sql = "SELECT * FROM CATEGORIA WHERE IDCATEGORIA = $id";

        $resultado = mysqli_query($conn, $sql);

        if($resultado && mysqli_num_rows($resultado) > 0){
            
            while($linha = mysqli_fetch_assoc($resultado)){
                $dadosCategoria = array_map('utf8_encode', $linha);

            }
            $dados = array(
                "tipo" => 'success',
                "mensagem" => '',
                "dados" => $dadosCategoria
            );
        } else {
            $dados = array(
                "tipo" => 'error',
                "mensagem" => 'nao foi possivel localizar a categoria',
                "dados" => array()
    
            );
        }




    } else {
        $dados = array(
            "tipo" => 'info',
            "mensagem" => 'nao foi possivel conectar ao banco de dados',
            "dados" => array()

        );
    }
    echo json_encode($dados, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);