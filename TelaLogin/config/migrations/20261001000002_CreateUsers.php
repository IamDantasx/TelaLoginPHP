<?php
declare(strict_types=1);

use Migrations\BaseMigration;

/**
 * Professores e coordenadores. Também guarda o token de troca de senha.
 */
class CreateUsers extends BaseMigration
{
    public function change(): void
    {
        $this->table('users', ['signed' => false])
            ->addColumn('curso_id', 'integer', ['signed' => false, 'null' => true])
            ->addColumn('nome', 'string', ['limit' => 150])
            ->addColumn('username', 'string', ['limit' => 60])
            ->addColumn('email', 'string', ['limit' => 150])
            ->addColumn('password', 'string', ['limit' => 255])
            // professor | coordenador | coordenacao_geral
            ->addColumn('perfil', 'string', ['limit' => 30, 'default' => 'professor'])
            ->addColumn('materia', 'string', ['limit' => 100, 'null' => true])
            ->addColumn('foto', 'string', ['limit' => 255, 'null' => true])
            ->addColumn('primeiro_acesso', 'boolean', ['default' => true])
            // false = desvinculado do curso
            ->addColumn('ativo', 'boolean', ['default' => true])
            // "Esqueci minha senha" e confirmação da troca de senha
            ->addColumn('token_senha', 'string', ['limit' => 64, 'null' => true])
            ->addColumn('token_expira_em', 'datetime', ['null' => true])
            ->addColumn('nova_senha', 'string', ['limit' => 255, 'null' => true])
            ->addColumn('created', 'datetime', ['null' => true])
            ->addColumn('modified', 'datetime', ['null' => true])
            ->addIndex(['username'], ['unique' => true])
            ->addIndex(['email'], ['unique' => true])
            ->addIndex(['token_senha'], ['unique' => true])
            ->addForeignKey('curso_id', 'cursos', 'id', ['delete' => 'SET_NULL', 'update' => 'NO_ACTION'])
            ->create();
    }
}
