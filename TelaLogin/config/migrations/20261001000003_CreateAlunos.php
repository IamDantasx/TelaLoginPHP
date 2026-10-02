<?php
declare(strict_types=1);

use Migrations\BaseMigration;

/**
 * Alunos, com turma, sala e responsável na própria tabela.
 */
class CreateAlunos extends BaseMigration
{
    public function change(): void
    {
        $this->table('alunos', ['signed' => false])
            ->addColumn('curso_id', 'integer', ['signed' => false, 'null' => false])
            ->addColumn('nome', 'string', ['limit' => 150])
            ->addColumn('matricula', 'string', ['limit' => 30, 'null' => true])
            ->addColumn('turma', 'string', ['limit' => 20])
            ->addColumn('sala', 'string', ['limit' => 20, 'null' => true])
            ->addColumn('responsavel_nome', 'string', ['limit' => 150, 'null' => true])
            ->addColumn('responsavel_telefone', 'string', ['limit' => 20, 'null' => true])
            ->addColumn('created', 'datetime', ['null' => true])
            ->addColumn('modified', 'datetime', ['null' => true])
            ->addIndex(['matricula'], ['unique' => true])
            ->addForeignKey('curso_id', 'cursos', 'id', ['delete' => 'RESTRICT', 'update' => 'NO_ACTION'])
            ->create();
    }
}
