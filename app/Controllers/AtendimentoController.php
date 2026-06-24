<?php

class AtendimentoController
{

    private PDO $pdo;

    public function __construct()
    {
        require __DIR__ . '/../../config/database.php';
        $this->pdo = $pdo;
    }

    public function listar(): void
    {
        header('Content-Type: application/json; charset=utf-8');

        $sql = 'SELECT id, pessoa_id, usuario_id, tipo_atendimento_id, descricao, data_atendimento, status, horario_atendimento, observacao_final, criado_em, atualizado_em
                FROM atendimentos
                ORDER BY id DESC';

        $stmt = $this->pdo->query($sql);
        $atendimentos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode($atendimentos, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    public function buscarPorId(): void
    {
        header('Content-Type: application/json; charset=utf-8');

        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        if (!$id) {
            http_response_code(400);
            echo json_encode(['erro' => 'ID inválido']);
            return;
        }

        $sql = 'SELECT id, pessoa_id, usuario_id, tipo_atendimento_id, descricao, data_atendimento, status, horario_atendimento, observacao_final, criado_em, atualizado_em
                FROM atendimentos
                WHERE id = :id';

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $atendimento = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$atendimento) {
            http_response_code(404);
            echo json_encode(['erro' => 'Atendimento não encontrado.']);
            return;
        }

        echo json_encode($atendimento, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    public function criar(): void
    {
        header('Content-Type: application/json; charset=utf-8');

        $pessoa_id           = filter_input(INPUT_POST, 'pessoa_id',           FILTER_VALIDATE_INT);
        $usuario_id          = filter_input(INPUT_POST, 'usuario_id',          FILTER_VALIDATE_INT);
        $tipo_atendimento_id = filter_input(INPUT_POST, 'tipo_atendimento_id', FILTER_VALIDATE_INT);
        $descricao           = trim($_POST['descricao']        ?? '');
        $data_atendimento    = trim($_POST['data_atendimento'] ?? '');
        $horario_atendimento = trim($_POST['horario_atendimento'] ?? '');
        $observacao_final    = trim($_POST['observacao_final'] ?? '');
        $status              = $_POST['status'] ?? 'aberto';

        if (!$pessoa_id || !$usuario_id || !$tipo_atendimento_id || $data_atendimento === '') {
            http_response_code(400);
            echo json_encode(['erro' => 'pessoa_id, usuario_id, tipo_atendimento_id e data_atendimento são obrigatórios.']);
            return;
        }

        if (!in_array($status, ['aberto', 'em_andamento', 'encerrado'], true)) {
            http_response_code(400);
            echo json_encode(['erro' => 'Status inválido.']);
            return;
        }

        try {
            $sql = 'INSERT INTO atendimentos (pessoa_id, usuario_id, tipo_atendimento_id, descricao, data_atendimento, status, horario_atendimento, observacao_final)
                    VALUES (:pessoa_id, :usuario_id, :tipo_atendimento_id, :descricao, :data_atendimento, :status, :horario_atendimento, :observacao_final)';

            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':pessoa_id',           $pessoa_id,           PDO::PARAM_INT);
            $stmt->bindValue(':usuario_id',          $usuario_id,          PDO::PARAM_INT);
            $stmt->bindValue(':tipo_atendimento_id', $tipo_atendimento_id, PDO::PARAM_INT);
            $stmt->bindValue(':descricao',           $descricao);
            $stmt->bindValue(':data_atendimento',    $data_atendimento);
            $stmt->bindValue(':status',              $status);
            $stmt->bindValue(':horario_atendimento', $horario_atendimento);
            $stmt->bindValue(':observacao_final',    $observacao_final);
            $stmt->execute();

            http_response_code(201);
            echo json_encode([
                'mensagem' => 'Atendimento cadastrado com sucesso.',
                'id'       => $this->pdo->lastInsertId()
            ], JSON_UNESCAPED_UNICODE);
        } catch (PDOException $e) {
            http_response_code(500);
            echo json_encode(['erro' => 'Erro ao cadastrar atendimento.']);
        }
    }

    public function atualizar(): void
    {
        header('Content-Type: application/json; charset=utf-8');

        $id                  = filter_input(INPUT_POST, 'id',                  FILTER_VALIDATE_INT);
        $pessoa_id           = filter_input(INPUT_POST, 'pessoa_id',           FILTER_VALIDATE_INT);
        $usuario_id          = filter_input(INPUT_POST, 'usuario_id',          FILTER_VALIDATE_INT);
        $tipo_atendimento_id = filter_input(INPUT_POST, 'tipo_atendimento_id', FILTER_VALIDATE_INT);
        $descricao           = trim($_POST['descricao']           ?? '');
        $data_atendimento    = trim($_POST['data_atendimento']    ?? '');
        $horario_atendimento = trim($_POST['horario_atendimento'] ?? '');
        $observacao_final    = trim($_POST['observacao_final']    ?? '');
        $status              = $_POST['status'] ?? 'aberto';

        if (!$id || !$pessoa_id || !$usuario_id || !$tipo_atendimento_id || $data_atendimento === '') {
            http_response_code(400);
            echo json_encode(['erro' => 'ID, pessoa_id, usuario_id, tipo_atendimento_id e data_atendimento são obrigatórios.']);
            return;
        }

        if (!in_array($status, ['aberto', 'em_andamento', 'encerrado'], true)) {
            http_response_code(400);
            echo json_encode(['erro' => 'Status inválido.']);
            return;
        }

        try {
            $sql = 'UPDATE atendimentos
                    SET pessoa_id           = :pessoa_id,
                        usuario_id          = :usuario_id,
                        tipo_atendimento_id = :tipo_atendimento_id,
                        descricao           = :descricao,
                        data_atendimento    = :data_atendimento,
                        status              = :status,
                        horario_atendimento = :horario_atendimento,
                        observacao_final    = :observacao_final
                    WHERE id = :id';

            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':pessoa_id',           $pessoa_id,           PDO::PARAM_INT);
            $stmt->bindValue(':usuario_id',          $usuario_id,          PDO::PARAM_INT);
            $stmt->bindValue(':tipo_atendimento_id', $tipo_atendimento_id, PDO::PARAM_INT);
            $stmt->bindValue(':descricao',           $descricao);
            $stmt->bindValue(':data_atendimento',    $data_atendimento);
            $stmt->bindValue(':status',              $status);
            $stmt->bindValue(':horario_atendimento', $horario_atendimento);
            $stmt->bindValue(':observacao_final',    $observacao_final);
            $stmt->bindValue(':id',                  $id, PDO::PARAM_INT);
            $stmt->execute();

            echo json_encode(['mensagem' => 'Atendimento atualizado com sucesso.'], JSON_UNESCAPED_UNICODE);
        } catch (PDOException $e) {
            http_response_code(500);
            echo json_encode(['erro' => 'Erro ao atualizar atendimento.']);
        }
    }

    public function excluir(): void
    {
        header('Content-Type: application/json; charset=utf-8');

        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

        if (!$id) {
            http_response_code(400);
            echo json_encode(['erro' => 'ID inválido.']);
            return;
        }

        try {
            $sql = 'DELETE FROM atendimentos WHERE id = :id';
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            echo json_encode(['mensagem' => 'Atendimento excluído com sucesso.'], JSON_UNESCAPED_UNICODE);
        } catch (PDOException $e) {
            http_response_code(500);
            echo json_encode(['erro' => 'Erro ao excluir atendimento.']);
        }
    }
}