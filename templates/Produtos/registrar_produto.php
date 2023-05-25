<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        Registrar Produto
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->css('register_product') ?>
</head>
<body>
    <div class="new-product-container" style="min-height: 100%;">
        <h1>Registrar Produto</h1>
        <p>Cadastre seu produto</p>
        <?= $this->Form->create(null, ['url' => ['action' => 'add'], 'id' => 'product_form', 'class' => 'form', 'method' => 'POST']) ?>
            <?= $this->Html->meta('csrfToken', $this->request->getAttribute('csrfToken')) ?>
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
                <?= $this->Form->button('Registrar', ['class' => 'btn-submit']) ?>
            </div>
        <?= $this->Form->end() ?>
    </div>
    <?= $this->Html->script('register_product') ?>
</body>
<?= $this->Html->script('jquery.mask') ?>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script>
    $(".mask-money").unmask().mask("#.##0,00", {reverse: true, placeholder: "0,00" });
</script>

<!-- <script>
    $(document).ready(function () {
        $("#unidade_create").on("change", function (event) {
            let unidade = $(this).val();
            let addon = $("#addon");
            if (unidade) {
                addon.removeClass("d-none");
                switch (unidade) {
                    case "unidade":
                        $("#quantidade_create").attr("step", "1");
                        addon.html("un");
                        break;
                    case "litro":
                        $("#quantidade_create").attr("step", "0.001");
                        addon.html("lt");
                        break;
                    case "quilograma":
                        $("#quantidade_create").attr("step", "0.001");
                        addon.html("kg");
                        break;
                    default:
                        $("#quantidade_create").attr("step", "1");
                        addon.addClass("d-none");
                        addon.html("");
                        break;
                }
            } else {
                $("#quantidade_create").attr("step", "1");
                addon.addClass("d-none");
                addon.html("");
            }
        });

        $(".mask-money").unmask().mask("#.##0,00", {
            reverse: true,
            placeholder: "0,00"
        });



        $("#perecivel_create").on("change", function () {
            if ($(this).is(":checked")) {
                $(this).val(1);
                $("#div_validade").removeClass("d-none");
            } else {
                $(this).val(0);
                $("#div_validade").addClass("d-none");
                $("#data_validade_create").val("");
            }
        });

        $("#product_form").on("submit", function (event) {
            event.preventDefault();

            if (validation($(".form-register input, .form-register select"))) {
                $(this).unbind("submit").submit();
            }
        });
    });

    function validation (campos) {
        var validation = true;

        campos.each(function () {
            let campo = $(this);
            if (campo.val() == "" && campo.attr("name") != "validade") {
                toastr.warning(`O campo ${campo.attr("name").charAt(0).toUpperCase() + campo.attr("name").slice(1)} é obrigatório!`);
                campo.css("border", "1px solid red");
                validation = false;
            } else if (campo.attr("name") == "validade" && $("#perecivel_create").is(":checked")) {
                if (campo.val() == "") {
                    validation = false;
                    toastr.warning("O campo Validade é obrigatório!");
                    campo.css("border", "1px solid red");
                } else if (campo.val() < $("#data_fabricacao_create").val()) {
                    toastr.warning("A data de validade não pode ser menor que a data de fabricação!");
                    validation = false;
                } else {
                    campo.css("border", "1px solid #222");
                }
            } else {
                campo.css("border", "1px solid #222");
            }
        });

        return validation;
    }
</script> -->
</html>
