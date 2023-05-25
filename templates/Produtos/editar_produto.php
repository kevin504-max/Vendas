<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        Atualizar Produto
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->css('register_product') ?>
</head>
<body>
    <div class="new-product-container" style="min-height: 100%;">
        <h1>Atualizar Produto</h1>
        <p>Atualize seu produto</p>
        <?= $this->Form->create(null, ['url' => ['action' => 'edit'], 'id' => 'product_form', 'class' => 'form', 'method' => 'POST']) ?>
            <?= $this->Html->meta('csrfToken', $this->request->getAttribute('csrfToken')) ?>
            <?= $this->Form->number('id', ['id' => 'id', 'name' => 'id', 'type' => 'hidden']) ?>
            <div class="form-register">
                <?= $this->Form->label('nome', 'Nome') ?>
                <?= $this->Form->text('nome', ['id' => 'nome', 'placeholder' => 'Entre com o nome do produto', 'maxlength' => 50]) ?>
            </div>
            <div class="form-register">
                <?= $this->Form->label('unidade', 'Unidade de medida') ?>
                <?= $this->Form->select('unidade', ['' => 'Selecione uma unidade', 'unidade' => 'Unidade', 'litro' => 'Litro', 'quilograma' => 'Quilograma'], ['id' => 'unidade']) ?>
            </div>
            <div class="form-register">
                <?= $this->Form->label('quantidade', 'Quantidade') ?>
                <div class="group-register">
                    <?= $this->Form->number('quantidade', ['id' => 'quantidade', 'placeholder' => 'Quantidade']) ?>
                    <div id="addon" class="group-addon d-none"></div>
                </div>
            </div>
            <div class="form-register">
                <?= $this->Form->label('preco', 'Preço') ?>
                <?= $this->Form->number('preco', ['id' => 'preco', 'class' => 'mask-money', 'type' => 'text']) ?>
            </div>
            <div class="form-register">
                <?= $this->Form->label('perecivel', 'É perecível?') ?>
                <label class="toggle">
                    <?= $this->Form->checkbox('perecivel', ['id' => 'perecivel']) ?>
                    <span class="slider round"></span>
                </label>
            </div>
            <div id="div_validade" class="form-register d-none">
                <?= $this->Form->label('validade', 'Data de validade') ?>
                <?= $this->Form->date('validade', ['id' => 'data_validade', 'min' => '1963-01-01', 'max' => '2099-12-31']) ?>
            </div>
            <div class="form-register">
                <?= $this->Form->label('fabricacao', 'Data de fabricação') ?>
                <?= $this->Form->date('fabricacao', ['id' => 'data_fabricacao', 'min' => '1963-01-01', 'max' => '2099-12-31']) ?>
            </div>
            <div class="actions">
                <a href="<?= $this->Url->build('/produtos/index') ?>" type="button" class="btn-cancel">Cancelar</a>
                <?= $this->Form->button('Atualizar', ['class' => 'btn-submit']) ?>
            </div>
        <?= $this->Form->end() ?>
    </div>
    <?= $this->Html->script('register_product') ?>
</body>
<?= $this->Html->script('jquery.mask') ?>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function () {
        $(".mask-money").unmask().mask("#.##0,00", {reverse: true, placeholder: "0,00" });
        $("#id").val("<?= $produto->id ?>")
        $("#nome").val("<?= $produto->nome ?>");
        $("#unidade").val("<?= $produto->unidade_medida ?>");
        $("#quantidade").val("<?= $produto->quantidade ?>");
        $("#preco").val("<?= $produto->preco ?>");
        $("#perecivel").prop("checked", <?= ($produto->produto_perecivel) ? 'true' : 'false' ?>);

        if($("#perecivel").prop("checked")) {
            $("#div_validade").removeClass("d-none");
            $("#data_validade").val("<?= ($produto->data_validade) ? $produto->data_validade->format('Y-m-d') : null ?>");
        } else {
            $("#div_validade").addClass("d-none");
        }

        $("#data_fabricacao").val("<?= $produto->data_fabricacao->format('Y-m-d') ?>");
    });
</script>
</html>
