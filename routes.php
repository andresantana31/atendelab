<?php 

require_once __DIR__ . '/app/Controllers/UsuarioController.php';

$controller = $_GET ['controller'] ?? 'home';
$action = $_GET ['action'] ?? 'index';

if($controller === 'usuarios') {
    $usuarioController = new UsuarioController();

    switch ($action){
        case 'listar';
            $usuarioController->listar();
            break;
        case 'buscar';
            $usuarioController->buscarPorId();
        break;
        case 'criar';
            $usuarioController->criar();
        break;
        case 'atualizar';
            $usuarioController->atualizar();
        break;
        case 'excluir';
            $usuarioController->excluir();
        break;

        default;
            echo 'Ação de usuários não encontrado';
            break;
    }

}else{
    echo '<h1>AtendeLab</h1>';
    echo '<p>Projeto em execução. Use ?controller=usuarios&action=listar para testar.</p>';
}

?>