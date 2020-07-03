<?php

    include('../../database/connection.php');

    if(!$conn){
        $dados = array(
            'tipo' => TYPE_MSG_INFO,
            'mensagem' => 'Não conectou ao banco'
        );
    }else{

        $requestData = $_REQUEST;

        //CASO TENHA PROBLEMA DE UTF-8
        // $requestData = array_map('utf-8_decode', $requestData);

        $requestData['ativo'] = $requestData['ativo'] == "on" ? "S" : "N";
         
        $date = date_create_from_format('d/m/Y H:i:s', $requestData['dataagora'])

        //$requestData['dataagora'] = date('Y-d-m H:i:s', strtotime($requestData['dataagora']));

        $requestData['dataagora'] = date_format($date , 'Y/m/d H:i:s' )

        if(empty($requestData['nome']) && empty($requestData['ativo'])){
            $dados = array(
                'tipo' => 'info',
                'mensagem' => 'Não conectou ao banco'
            );
        }else{
            $sqlComando = "INSERT INTO CATEGORIES(nome, ativo, datacriacao, datamodificacao) VALUE('$requestData[nome]','$requestData[ativo]','$requestData[dataagora]','$requestData[dataagora]')";
            $resultado = mysqli_query($conn, $sqlComando);

            if($resultado){
                $dados = array(
                    'tipo' => TYPE_MSG_SUCCESS,
                    'mensagem' => 'Cadastrado'
                );
            }else{
                $dados = array(
                    'tipo' => TYPE_MSG_ERROR,
                    'mensagem' => 'Não cadatrado'
                );
            }
        }



        mysqli_close($conn);
    }

    echo json_encode($dados, JSON_UNESCAPED_SLASHES, JSON_UNESCAPED_UNICODE);
?>