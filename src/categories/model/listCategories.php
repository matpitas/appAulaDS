<?php

    include('../../database/connection.php');

    if($conn){

        $requestData = $_REQUEST;

        $colummns = $requestData['colummns'];

        $sql = "SELECT IDCATEGORIA, NOME, ATIVO, DATAMODIFICACAO FROM CATEGORIAS WHERE 1=1 ";

        $resultado = mysqli_query($conn, $sql);

        $qtdeLinhas = mysqli_num_rows($resultado);

        if(!empty($requestData['search']['value'])){
            $sql .= " AND (IDCATEGORIA LIKE '$requestData['search']['value'])%' ";
            $sql .= " OR NOME LIKE '$requestData['search']['value')]%' )";

        }
        $resultado = mysqli_query($conn, $sql);
        $totalFiltrados  = mysqli_num_rows($resultado);

        $colunaOrdem = $requestData['order']['0']['column'];
        $ordem = $colunas[$colunaOrdem];
        $direcao = $requestData['order']['0']['dir'];

        $sql .= " ORDER BY $ordem $direcao LIMIT $requestData[start], $requestData[length] ";

        $dados = array();
        while($linha = mysqli_fetch_assoc($resultado)){
            $dados[] = array_map('utf8_encode', $linha);
        }

        $json_data = array(
            "draw" => intval($requestData['draw']),
            "recordsTotal" => intval($qtdeLinhas),
            "recordsFiltered" => $totalFiltrados,
            "data" => $dados
        );

        mysqli_close($conn);
    }   else{
        $json_data = array(
            "draw" => 0,
            "recordsTotal" => 0,
            "recordsFiltered" => 0,
            "data" => array()
        );
    }


    echo json_encode($json_data, JSON_UNESCAPED_SLASHES, JSON_UNESCAPED_UNICODE);
?>