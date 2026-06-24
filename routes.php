<?php

require_once __DIR__ . '/app/Controllers/UsuarioController.php';
require_once __DIR__ . '/app/Controllers/TipoAtendimentoController.php';
require_once __DIR__ . '/app/Controllers/PessoaController.php';
require_once __DIR__ . '/app/Controllers/AtendimentoController.php';
require_once __DIR__ . '/app/Controllers/AuthController.php';
require_once __DIR__ . '/app/Controllers/Middleware/auth.php';

$controller = $_GET['controller'] ?? 'auth';
$action     = $_GET['action']     ?? 'login';

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

    case 'tipo_atendimento':

        exigirAutenticao();

        $tipoAtendimentoController = new TipoAtendimentoController();

        switch ($action) {

            case 'listar':
                $tipoAtendimentoController->listar();
                break;

            case 'buscar':
                $tipoAtendimentoController->buscarPorId();
                break;

            case 'criar':
                $tipoAtendimentoController->criar();
                break;

            case 'atualizar':
                $tipoAtendimentoController->atualizar();
                break;

            case 'excluir':
                $tipoAtendimentoController->excluir();
                break;

            default:
                http_response_code(404);
                echo 'Ação de tipos de atendimento não encontrada';
                break;
        }

        break;

    case 'pessoa':

        exigirAutenticao();

        $pessoaController = new PessoaController();

        switch ($action) {

            case 'listar':
                $pessoaController->listar();
                break;

            case 'buscar':
                $pessoaController->buscarPorId();
                break;

            case 'criar':
                $pessoaController->criar();
                break;

            case 'atualizar':
                $pessoaController->atualizar();
                break;

            case 'excluir':
                $pessoaController->excluir();
                break;

            default:
                http_response_code(404);
                echo 'Ação de pessoas não encontrada';
                break;
        }

        break;

    case 'atendimento':

        exigirAutenticao();

        $atendimentoController = new AtendimentoController();

        switch ($action) {

            case 'listar':
                $atendimentoController->listar();
                break;

            case 'buscar':
                $atendimentoController->buscarPorId();
                break;

            case 'criar':
                $atendimentoController->criar();
                break;

            case 'atualizar':
                $atendimentoController->atualizar();
                break;

            case 'excluir':
                $atendimentoController->excluir();
                break;

            default:
                http_response_code(404);
                echo 'Ação de atendimentos não encontrada';
                break;
        }

        break;

    default:
        http_response_code(404);
        echo 'Controller não encontrado';
        break;
}