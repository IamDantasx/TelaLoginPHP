<?php
declare(strict_types=1);

use Migrations\BaseMigration;

/**
 * Cursos (ex.: Informática).
 */
class CreateCursos extends BaseMigration
{
    public function change(): void
    {
        $this->table('cursos', ['signed' => false])
            ->addColumn('nome', 'string', ['limit' => 100])
            ->addColumn('created', 'datetime', ['null' => true])
            ->addColumn('modified', 'datetime', ['null' => true])
            ->addIndex(['nome'], ['unique' => true])
            ->create();
    }
}
