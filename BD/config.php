<?php
    //Este documento é responsavel pela conexão com o banco de dados! Para caso as páginas puxem diretamente informações, sem precisar das classes.
    try {
        $pdo = new PDO("mysql:host=localhost;dbname=db_hp", "root", '11153025192Fd@');
        //echo "Conexão com banco de dados foi realizada com sucesso" . "<br>";
    }
    catch(PDOException $e){
        echo "Falha: " . $e->getMessage();
        exit();
    }
?>