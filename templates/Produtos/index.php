<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        Lista de Produtos
        <?= $this->fetch('title') ?>
    </title>
</head>
<body>
    <div class="products-container">
        <div class="title-container">
            <h1>Lista de Produtos</h1>
            <div class="actions">
                <a href="<?= $this->Url->build('/produtos/register') ?>" type="button" class="action-btn">Registrar Produto</a>
            </div>
        </div>
        <?php if (count($produtos) > 0): ?>
            <table class="table table-striped table-responsive mb-4">
                <thead class="thead-dark">
                    <tr>
                        <th class="text-center align-middle" scope="col">Nome</th>
                        <th class="text-center align-middle" scope="col">Unidade</th>
                        <th class="text-center align-middle" scope="col">Quantidade</th>
                        <th class="text-center align-middle" scope="col">Preço</th>
                        <th class="text-center align-middle" scope="col">Perecível</th>
                        <th class="text-center align-middle" scope="col">Data de Validade</th>
                        <th class="text-center align-middle" scope="col">Data de Fabricação</th>
                        <th class="text-center align-middle" scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($produtos as $produto): ?>
                        <tr>
                            <td class="text-center"><strong><?= $produto->nome ?></strong></td>
                            <td class="text-center"><strong><?= $produto->unidade_medida ?></strong></td>
                            <td class="text-center"><strong><?= $produto->quantidade ?></strong></td>
                            <td class="text-center"><strong><?= $produto->preco ?></strong></td>
                            <td class="text-center"><strong><?= $produto->perecivel ? 'Sim' : 'Não' ?></strong></td>
                            <td class="text-center"><strong><?= $produto->data_validade ?? '-' ?></strong></td>
                            <td class="text-center"><strong><?= $produto->data_fabricacao ?></strong></td>
                            <td class="text-center">
                                <span data-toggle="tooltip" data-placement="top" title="Visualizar">
                                    <a href="<?= $this->Url->build(['controller' => 'Produtos', 'action' => 'update', $produto->id]) ?>" type="button" class="action-btn action-btn-circle"><ion-icon name="eye-outline" style="font-size: 15px;"></ion-icon></a>
                                </span>
                                <span data-toggle="tooltip" data-placement="top" title="Editar">
                                    <a href="<?= $this->Url->build(['controller' => 'Produtos', 'action' => 'update', $produto->id]) ?>" type="button" class="action-btn action-btn-circle"><ion-icon name="pencil-outline" style="font-size: 15px;"></ion-icon></a>
                                </span>
                                <span data-toggle="tooltip" data-placement="top" title="Excluir">
                                    <a type="button" class="action-btn action-btn-circle" data-toggle="modal" data-target="#modalDeleteProduto" data-id="<?= $produto->id ?>"><ion-icon name="trash-outline" style="font-size: 15px;"></ion-icon></a>
                                </span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="not-found">
                <img src="<?= $this->Url->image('Meerkats.svg', ['alt' => 'Nenhum produto cadastrado até o momento...']) ?>" width="400" />
                <h2>Nenhum produto cadastrado até o momento...</h2>
            </div>
        <?php endif; ?>
    </div>
    <!-- MODAL DELETE PRODUTO -->
    <div id="modalDeleteProduto" class="modal inmodal fade" data-backdrop="static" tabindex="-1" role="dialog" aria-modal="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal" aria-label="Fechar"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Excluir Produto</h4>
                </div>
                <div class="modal-body">
                    <p>Tem certeza que deseja <strong>excluir</strong> este produto?</p>
                    <p class="text-danger font-weight-bold">Essa ação não poderá ser desfeita.</p>
                </div>
                <?= $this->Form->create(null, ['url' => ['action' => 'delete'], 'method' => 'POST']) ?>
                    <?= $this->Html->meta('csrfToken', $this->request->getAttribute('csrfToken')) ?>
                    <?= $this->Form->number('id', ['id' => 'id', 'name' => 'id', 'type' => 'hidden']) ?>
                    <div class="modal-footer">
                        <?= $this->Form->button('Cancelar', ['class' => 'btn btn-white', 'type' => 'button', 'data-dismiss' => 'modal']) ?>
                        <?= $this->Form->button('Excluir', ['class' => 'btn btn-danger']) ?>
                    </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</body>
<?= $this->Html->script('index.js') ?>
<script>
    $(document).ready(function() {
        $('#modalDeleteProduto').on('show.bs.modal', function (event) {
            $(this).find('#id').val($(event.relatedTarget).data('id'));
        });
    });
</script>
</html>
