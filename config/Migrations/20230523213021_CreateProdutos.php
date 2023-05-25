<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateProdutos extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change(): void
    {
        $table = $this->table('produtos');
        $table
            ->addColumn('nome', 'text', ['null' => false])
            ->addColumn('unidade_medida', 'enum', [
                'values' => ['unidade', 'litro', 'quilograma'],
                'null' => false
            ])
            ->addColumn('quantidade', 'integer', ['null' => true])
            ->addColumn('preco', 'decimal', [
                'precision' => 10,
                'scale' => 2,
                'null' => false
            ])
            ->addColumn('produto_perecivel', 'boolean', ['null' => false])
            ->addColumn('data_validade', 'date', ['null' => true])
            ->addColumn('data_fabricacao', 'date', ['null' => false])
            ->create();
    }
}
