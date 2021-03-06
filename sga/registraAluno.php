<?php

    require_once('repository/AlunoRepository.php');
    require_once('util/base64.php');

    
    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $matricula = filter_input(INPUT_POST, 'matricula', FILTER_SANITIZE_NUMBER_INT);

    $foto = converterBase64($_FILES['foto']);

    if(empty($nome) || empty($email) || empty($matricula) || empty($foto)) {
        $msg = "Preencher todos os campos primeiro.";
    } else {
        if(fnAddAluno($nome, $foto, $email, $matricula)) {
            $msg = "Sucesso ao gravar";
        } else {
            $msg = "Falha na gravação";
        }
    }
    
    $page = "formulario-cadastro-aluno.php";
    setcookie('notify', $msg, time() + 10, "sga/{$page}", 'localhost');
    
    header("location: {$page}");
    exit;