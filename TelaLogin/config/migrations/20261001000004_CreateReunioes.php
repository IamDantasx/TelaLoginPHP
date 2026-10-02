<?php
declare(strict_types=1);

use Migrations\BaseMigration;

/**
 * Reuniões/atendimentos, incluindo encaminhamento e reagendamento.
 */
class CreateReunioes extends BaseMigration
{
    public function change(): void
    {
        $this->table('reunioes', ['signed' => false])
            ->addColumn('aluno_id', 'integer', ['signed' => false, 'null' => false])
            // responsável pelo atendimento
            ->addColumn('user_id', 'integer', ['signed' => false, 'null' => false])
            // Documentação | Desempenho acadêmico | Comportamento | Notas | Faltas
            ->addColumn('motivo', 'string', ['limit' => 60])
            ->addColumn('data_hora', 'datetime')
            // agendada | encaminhada | realizada | nao_compareceu | reagendada | cancelada
            ->addColumn('status', 'string', ['limit' => 20, 'default' => 'agendada'])
            ->addColumn('observacoes', 'text', ['null' => true])
            ->addColumn('encaminhado_por_id', 'integer', ['signed' => false, 'null' => true])
            // coordenacao_curso | coordenacao_geral
            ->addColumn('encaminhado_para', 'string', ['limit' => 30, 'null' => true])
            // reunião original, quando esta é um reagendamento
            ->addColumn('reuniao_origem_id', 'integer', ['signed' => false, 'null' => true])
            ->addColumn('created', 'datetime', ['null' => true])
            ->addColumn('modified', 'datetime', ['null' => true])
            ->addIndex(['user_id', 'data_hora'])
            ->addForeignKey('aluno_id', 'alunos', 'id', ['delete' => 'RESTRICT', 'update' => 'NO_ACTION'])
            ->addForeignKey('user_id', 'users', 'id', ['delete' => 'RESTRICT', 'update' => 'NO_ACTION'])
            ->addForeignKey('encaminhado_por_id', 'users', 'id', ['delete' => 'SET_NULL', 'update' => 'NO_ACTION'])
            ->addForeignKey('reuniao_origem_id', 'reunioes', 'id', ['delete' => 'SET_NULL', 'update' => 'NO_ACTION'])
            ->create();
    }
}
