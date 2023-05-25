<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Produto Entity
 *
 * @property int $id
 * @property string $nome
 * @property string $unidade_medida
 * @property int|null $quantidade
 * @property string $preco
 * @property bool $produto_perecivel
 * @property \Cake\I18n\FrozenDate|null $data_validade
 * @property \Cake\I18n\FrozenDate $data_fabricacao
 */
class Produto extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected $_accessible = [
        'nome' => true,
        'unidade_medida' => true,
        'quantidade' => true,
        'preco' => true,
        'produto_perecivel' => true,
        'data_validade' => true,
        'data_fabricacao' => true,
    ];
}
