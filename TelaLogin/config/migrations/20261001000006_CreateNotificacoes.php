<?php
declare(strict_types=1);

use Migrations\BaseMigration;

/**
 * Notificações de cada usuário.
 */
class CreateNotificacoes extends BaseMigration
{
    public function change(): void
    {
        $this->table('notificacoes', ['signed' => false])
            ->addColumn('user_id', 'integer', ['signed' => false, 'null' => false])
            ->addColumn('reuniao_id', 'integer', ['signed' => false, 'null' => true])
            // agendamento | alteracao | aviso
            ->addColumn('tipo', 'string', ['limit' => 20])
            ->addColumn('titulo', 'string', ['limit' => 150])
            ->addColumn('mensagem', 'text')
            // null = não lida
            ->addColumn('lida_em', 'datetime', ['null' => true])
            ->addColumn('created', 'datetime', ['null' => true])
            ->addColumn('modified', 'datetime', ['null' => true])
            ->addIndex(['user_id', 'lida_em'])
            ->addForeignKey('user_id', 'users', 'id', ['delete' => 'CASCADE', 'update' => 'NO_ACTION'])
            ->addForeignKey('reuniao_id', 'reunioes', 'id', ['delete' => 'SET_NULL', 'update' => 'NO_ACTION'])
            ->create();
    }
}
