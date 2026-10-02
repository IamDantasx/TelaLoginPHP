<?php
declare(strict_types=1);

use Migrations\BaseMigration;

/**
 * Horários de 30 min disponíveis ou bloqueados.
 */
class CreateDisponibilidades extends BaseMigration
{
    public function change(): void
    {
        $this->table('disponibilidades', ['signed' => false])
            ->addColumn('user_id', 'integer', ['signed' => false, 'null' => false])
            ->addColumn('data', 'date')
            ->addColumn('hora', 'time')
            // disponivel | bloqueado
            ->addColumn('status', 'string', ['limit' => 20, 'default' => 'disponivel'])
            ->addColumn('repetir_semanal', 'boolean', ['default' => false])
            ->addColumn('created', 'datetime', ['null' => true])
            ->addColumn('modified', 'datetime', ['null' => true])
            ->addIndex(['user_id', 'data', 'hora'], ['unique' => true])
            ->addForeignKey('user_id', 'users', 'id', ['delete' => 'CASCADE', 'update' => 'NO_ACTION'])
            ->create();
    }
}
