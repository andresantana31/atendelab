<?php

require_once __DIR__ . '/app/Controllers/UsuarioController.php';
require_once __DIR__ . '/app/Controllers/AuthController.php';
require_once __DIR__ . '/app/Controllers/Middleware/auth.php';

$controller = $_GET['controller'] ?? 'auth';
$action = $_GET['action'] ?? 'login';

switch ($controller) {

    case 'auth':

        $authController = new AuthController();

        switch ($action) {

            case 'login':
                $authController->exibirLogin();
                break;

            case 'entrar':
                $authController->entrar();
                break;

            case 'dashboard':
                $authController->dashboard();
                break;

            case 'logout':
                $authController->logout();
                break;

            default:
                http_response_code(404);
                echo 'Ação de autenticação não encontrada';
                break;
        }

        break;

    case 'usuario':

        exigirAutenticao();

        $usuarioController = new UsuarioController();

        switch ($action) {

            case 'listar':
                $usuarioController->listar();
                break;

            case 'buscar':
                $usuarioController->buscarPorId();
                break;

            case 'criar':
                $usuarioController->criar();
                break;

            case 'atualizar':
                $usuarioController->atualizar();
                break;

            case 'excluir':
                $usuarioController->excluir();
                break;

            default:
                http_response_code(404);
                echo 'Ação de usuários não encontrada';
                break;
        }

        break;

    default:
        http_response_code(404);
        echo 'Controller não encontrado';
        break;
}