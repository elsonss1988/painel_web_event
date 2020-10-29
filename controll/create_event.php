<?php
session_start();

require 'functions.php';
require '../connect/connect.php';

foreach ($_POST as $key => $value){
    echo "{$key} = {$value}\r\n";
}

$etapa = $_SESSION['etapa'];
$retornar = $_SESSION['retorna'];	

// Adiciona cliente e dados básicos do evento
if($etapa == 1){
    
    // verifica se já tem cliente
    if(!isset($_POST['cliente_id'])){
        $cliente_id = "";
    } else{
        $cliente_id = mysqli_real_escape_string($link, $_POST['cliente_id']);
    }
    
    // Pega dados gerais
    $evento_nome = mysqli_real_escape_string($link, $_POST['evento_nome']);
    $evento_data = mysqli_real_escape_string($link, $_POST['evento_data']);
    $evento_hora = mysqli_real_escape_string($link, $_POST['evento_hora']);
    
    // se o cliente não tem cadastro, pega os dados e sobe
    if($cliente_id == ""){
        $cliente_nome = mysqli_real_escape_string($link, $_POST['cliente_nome']);
        $cliente_site = mysqli_real_escape_string($link, $_POST['cliente_site']);
        $cliente_responsavel = mysqli_real_escape_string($link, $_POST['cliente_responsavel']);
        $cliente_logo = $_FILES['cliente_logo'];
        
        $cliente_id = add_cliente($cliente_nome, $cliente_site, $cliente_responsavel, $cliente_logo);
        $_SESSION['cliente_id'] = $cliente_id;
    } 
    
    // insere o novo evento e retorna id
    $evento_id = add_evento($cliente_id, $evento_nome, $evento_data, $evento_hora);
    $_SESSION['evento_id'] = $evento_id;
    
    // muda etapa e redireciona
    $_SESSION['etapa'] = 2;
}

// Adiciona convidados e personalização
if($etapa == 2){
    $evento_id = $_SESSION['evento_id'];
    
    if(!isset($_GET['f'])){
        $f = "";
    } else{
        $f = mysqli_real_escape_string($link, $_GET['f']);
    }
    if($f == 'add'){
        $convidados_nome = mysqli_real_escape_string($link, $_POST['convidados_nome']);
        $convidados_curriculo = mysqli_real_escape_string($link, $_POST['convidados_curriculo']);
        $convidados_bio = mysqli_real_escape_string($link, $_POST['convidados_bio']);
        $convidados_foto = $_FILES['convidados_foto'];
        $add_convidado = add_convidado($evento_id, $convidados_nome, $convidados_curriculo, $convidados_bio, $convidados_foto);
        if($add_convidado == 1){
            $get_convidados = get_convidados($evento_id);
            $_SESSION['list_convidados'] = array();
            
            $i = 0;
            if ($get_convidados->num_rows > 0) {
                while($row = $get_convidados->fetch_assoc()) { 
                    $_SESSION['list_convidados'][$i] = $row;
                    $i++;
                }
            }
        }
        
    } else if($f == 'edit'){
        $edit_convidados_nome = mysqli_real_escape_string($link, $_POST['edit_convidados_nome']);
        $edit_convidados_curriculo = mysqli_real_escape_string($link, $_POST['edit_convidados_curriculo']);
        $edit_convidados_bio = mysqli_real_escape_string($link, $_POST['edit_convidados_bio']);
        $edit_convidados_id = mysqli_real_escape_string($link, $_POST['edit_convidados_id']);
        if($_FILES['edit_convidados_foto']['size'] == 0){
            $edit_convidados_foto = 0;
        } else {
            $edit_convidados_foto = $_FILES['edit_convidados_foto'];
        }
        $edit_convidado = edit_convidado($edit_convidados_id, $edit_convidados_nome, $edit_convidados_curriculo, $edit_convidados_foto, $edit_convidados_bio);
        if($edit_convidado == 1){
            $get_convidados = get_convidados($evento_id);
            $_SESSION['list_convidados'] = array();
            
            $i = 0;
            if ($get_convidados->num_rows > 0) {
                while($row = $get_convidados->fetch_assoc()) { 
                    $_SESSION['list_convidados'][$i] = $row;
                    $i++;
                }
            }
        }
        
    } else if($f == 'del'){
        $del_convidados_id = mysqli_real_escape_string($link, $_POST['del_convidados_id']);
        $del_convidado = del_convidado($del_convidados_id);
        if($del_convidado == 1){
            $get_convidados = get_convidados($evento_id);
            $_SESSION['list_convidados'] = array();
            
            $i = 0;
            if ($get_convidados->num_rows > 0) {
                while($row = $get_convidados->fetch_assoc()) { 
                    $_SESSION['list_convidados'][$i] = $row;
                    $i++;
                }
            }
        }
    } else {
        $personalizacao_bg = $_FILES['personalizacao_bg'];
        $personalizacao_logo = $_FILES['personalizacao_logo'];
        $personalizacao_cor1 = mysqli_real_escape_string($link, $_POST['personalizacao_cor1']);
        $personalizacao_cor2 = mysqli_real_escape_string($link, $_POST['personalizacao_cor2']);
        if(isset($_POST['tipo_de_convidados'])){
            $tipo_de_convidados = mysqli_real_escape_string($link, $_POST['tipo_de_convidados']);
        } else {
            $tipo_de_convidados = 0;
        }
        $add_personalizacao = add_personalizacao($evento_id, $personalizacao_bg, $personalizacao_logo, $personalizacao_cor1, $personalizacao_cor2, $tipo_de_convidados);
        if($add_personalizacao == 1){
            $_SESSION['etapa'] = 3;
        }
    }
}

if($etapa == 3){
    $_SESSION['etapa'] = 4;
}

if($etapa == 4){
    $cadastro= new stdClass;


    $cadastro->nome=isset($_POST['campo_nome'])?1:null;
    $cadastro->sobrenome= isset($_POST['campo_sobrenome'])?1:null;
    $cadastro->email= isset($_POST['campo_email'])?1:null;
    $cadastro->telefone= isset($_POST['campo_telefone'])?1:null;
    $cadastro->celular= isset($_POST['campo_celular'])?1:null;
    $cadastro->empresa=  isset($_POST['campo_empresa'])?1:null;
    $cadastro->cargo= isset($_POST['campo_cargo'])?1:null;
    $cadastro->especialidade= isset($_POST['campo_especialidade'])?1:null;
    $cadastro->ufcrm= isset($_POST['campo_ufcrm"'])?1:null;
    $cadastro->senha= isset($_POST['campo_senha'])?1:null;
    $cadastro->senha_padrao= isset($_POST['senha_padrao'])?1:null;
    $cadastro->senha_aleatoria= isset($_POST['senha_aleatoria'])?1:null;
    $cadastro->senha_campo= isset($_POST['senha_campo'])?$_POST['senha_campo']:null;
    $cadastro->valida_crm= isset($_POST['valida_crm'])?1:null;
    $cadastro->valida_email= isset($_POST['valida_email'])?1:null;    
    
    if (!($cadastro->nome || $cadastro->sobrenome || $cadastro->email || $cadastro->telefone || $cadastro->celular || $cadastro->empresa || $cadastro->cargo || $cadastro->especialidade || $cadastro->ufcrm || $cadastro->senha)){
        $cadastro->flag=1;
        $_SESSION['invalid']=1;
        echo "Hello";
        echo "<script>confirm('Hello')</script>";
        echo "<script>alert('Mensagem');</script>";   
    }else{
        $cadastro->flag=0;
    }
    $cadastroJson=json_encode($cadastro);


    // if(is_null($cadastro)){
        
    //     $cadastro->flag=1;
    //     echo "<script>confirm('Hello')</script>";
    //     $_SESSION['etapa'] = 5;
    // }else{
    //     $cadastro->flag=0;
    // }
    // $file = fopen("cache.txt", "a+") or die("Unable to open file!");
    // fwrite($file,json_encode($cadastro));
    $sql="INSERT INTO configuracoes (lives_idlives,player1,campos_cadastro) VALUES (10,'MegaPlay','$cadastroJson')";
    mysqli_query($link, $sql);
    
    add_cadastro();
   

   
}
if($etapa == 5){
    $_SESSION['etapa'] = 6;
}
if($etapa == 6){
    $_SESSION['etapa'] = 7;
};

   if(retorna==1){   
      $_SESSION['etapa']=$etapa-2;
      header('Location: ../install/');
      $_SESSION['retorna']=0;
    }

header('Location: ../install/');

?>