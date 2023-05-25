<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        Cadastro
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->css('register_product') ?>
</head>
<body>
    <div class="new-product-container">
        <h1>Cadastro</h1>
        <p>Faça seu cadastro no sistema</p>
        <?= $this->Form->create(null, ['url' => ['action' => 'add'], 'id' => 'form_cadastro', 'class' => 'form', 'method' => 'POST']) ?>
            <?= $this->Html->meta('csrfToken', $this->request->getAttribute('csrfToken')) ?>
            <div class="form-register">
                <?= $this->Form->label('nome', 'Nome') ?>
                <?= $this->Form->text('nome', ['id' => 'nome_completo', 'placeholder' => 'Entre comseu nome completo', 'maxlength' => 50]) ?>
            </div>
            <div class="form-register">
                <?= $this->Form->label('email', 'E-mail') ?>
                <?= $this->Form->email('email', ['id' => 'email', 'placeholder' => 'Entre com seu e-mail', 'maxlength' => 50]) ?>
            </div>
            <div class="form-register">
                <?= $this->Form->label('password', 'Senha') ?>
                <?= $this->Form->password('password', ['id' => 'password', 'placeholder' => 'Entre com uma senha', 'maxlength' => 50]) ?>
            </div>
            <div class="form-register">
                <?= $this->Form->label('confirm_password', 'Confirme sua senha') ?>
                <?= $this->Form->password('confirm_password', ['id' => 'confirm_password', 'placeholder' => 'Confirme sua senha', 'maxlength' => 50]) ?>
            </div>
            <div class="actions">
                <a href="<?= $this->Url->build('/users/login') ?>" type="button" class="button" style="color: #222;">Já estou cadastrado</a>
                <?= $this->Form->button('Cadastrar', ['class' => 'btn-submit']) ?>
            </div>
        <?= $this->Form->end() ?>
    </div>
</body>
<script>
    $(document).ready(function () {
        $("#form_cadastro").on("submit", function (event) {
            event.preventDefault();

            let validation = true;

            $(".form-register input").each(function () {
                if ($(this).val() === "") {
                    validation = false;
                    toastr.warning("Preencha todos os campos!");
                    return false;
                }
            });

            if ($("#password").val() != $("#confirm_password").val()) {
                toastr.warning("As senhas não coincidem!");
                validation = false;
            }

            if (validation) {
                $(this).unbind("submit").submit();
            }
        });
    });
</script>
</html>
