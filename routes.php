<?php

require_once __DIR__ . '/app/Controllers/UsuarioController.php';
require_once __DIR__ . '/app/Controllers/TiposAtendimentosController.php';
require_once __DIR__ . '/app/Controllers/PessoasController.php';
require_once __DIR__ . '/app/Controllers/AtendimentosController.php';
require_once __DIR__ . '/app/Controllers/AuthController.php';
require_once __DIR__ . '/app/Middleware/auth.php';
require_once __DIR__ . '/app/Controllers/FrontendController.php';

$controller = $_GET['controller'] ?? 'auth';
$action     = $_GET['action']     ?? 'login';

switch ($controller) {

    case 'frontend':

        exigirAutenticacao();

        $frontendController = new FrontendController();

        switch ($action) {

            case 'pessoas':
                $frontendController->pessoas();
                break;

            case 'tipos':
                $frontendController->tiposAtendimentos();
                break;

            case 'atendimentos':
                $frontendController->atendimentos();
                break;

            default:
                http_response_code(404);
                echo 'Ação de frontend não encontrada';
                break;
        }

        break;

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

        exigirAutenticacao();

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

            default:
                http_response_code(404);
                echo 'Ação de usuários não encontrada';
                break;
        }

        break;

    case 'tipos':
        exigirAutenticacao();
        require_once __DIR__ . '/app/Controllers/TiposAtendimentosController.php';
        $tiposController = new TiposAtendimentosController();

        switch ($action) {
            case 'listar':
                $tiposController->listar();
                break;
            case 'buscar':
                $tiposController->buscarPorId();
                break;
            case 'criar':
                $tiposController->criar();
                break;
            case 'atualizar':
                $tiposController->atualizar();
                break;
            case 'inativar':
                $tiposController->inativar();
                break;
            default:
                responderRotaNaoEncontrada('Ação de tipos de atendimento não encontrada.');
        }
        break;

        break;

    case 'pessoas':

        exigirAutenticacao();

        $PessoasController = new PessoasController();

        switch ($action) {

            case 'listar':
                $PessoasController->listar();
                break;

            case 'buscar':
                $PessoasController->buscarPorId();
                break;

            case 'criar':
                $PessoasController->criar();
                break;

            case 'atualizar':
                $PessoasController->atualizar();
                break;
            case 'inativar':
                $PessoasController->inativar();
                break;

            default:
                http_response_code(404);
                echo 'Ação de pessoas não encontrada';
                break;
        }

        break;

    case 'atendimentos':
        exigirAutenticacao();
        require_once __DIR__
            . '/app/Controllers/AtendimentosController.php';
        $atendimentosController = new AtendimentosController();
        switch ($action) {
            case 'listar':
                $atendimentosController->listar();
                break;
            case 'visualizar':
                $atendimentosController->visualizar();
                break;
            case 'criar':
                $atendimentosController->criar();
                break;
            case 'alterarStatus':
            case 'atualizarStatus':
                $atendimentosController->atualizarStatus();
                break;
            case 'opcoesFormulario':
                $atendimentosController->opcoesFormulario();
                break;
            default:
                responderRotaNaoEncontrada(
                    'Ação de atendimentos não encontrada.'
                );
        }
        break;

    default:
        http_response_code(404);
        echo 'Controller não encontrado';
        break;
}