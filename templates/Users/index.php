<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        Lista de Usuários
        <?= $this->fetch('title') ?>
    </title>
</head>
<body>
<div class="products-container">
    <div class="title-container">
        <h1>Lista de Usuários</h1>
    </div>
    <?php if (count($users) > 0): ?>
        <table class="table table-striped table-responsive mb-4">
            <thead class="thead-dark">
                <tr>
                    <th class="text-center align-middle" scope="col">Nome</th>
                    <th class="text-center align-middle" scope="col">E-mail</th>
                    <th class="text-center align-middle" scope="col">Status</th>
                    <th class="text-center align-middle" scope="col">Data de inscrição</th>
                    <th class="text-center align-middle" scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td class="text-center"><strong><?= $user->nome_completo ?></strong></td>
                        <td class="text-center"><strong><?= $user->email ?></strong></td>
                        <td class="text-center"><strong><?= ($user->ativo) ? "Sim" : "Não" ?></strong></td>
                        <td class="text-center"><strong><?= $user->created ?></strong></td>
                        <td class="text-center">
                            <span data-toggle="tooltip" data-placement="top" title="Visualizar">
                                <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'update', $produto->id]) ?>" type="button" class="action-btn action-btn-circle"><ion-icon name="eye-outline" style="font-size: 15px;"></ion-icon></a>
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
</body>
</html>
