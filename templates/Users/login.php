<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        Login
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->css('register_product') ?>
</head>
<body>
    <div class="new-product-container">
        <h1>Login</h1>
        <p>Faça seu login no sistema</p>
        <?= $this->Form->create(null, ['url' => ['action' => 'authentication'], 'id' => 'form_login', 'class' => 'form', 'method' => 'POST']) ?>
            <?= $this->Html->meta('csrfToken', $this->request->getAttribute('csrfToken')) ?>
            <div class="form-register">
                <?= $this->Form->label('email', 'E-mail') ?>
                <?= $this->Form->email('email', ['id' => 'email', 'placeholder' => 'Entre com seu e-mail', 'maxlength' => 50]) ?>
            </div>
            <div class="form-register">
                <?= $this->Form->label('password', 'Senha') ?>
                <?= $this->Form->password('password', ['id' => 'password', 'placeholder' => 'Entre com sua senha', 'maxlength' => 50]) ?>
            </div>
            <div class="actions">
                <a href="<?= $this->Url->build('/users/register') ?>" type="button" class="button" style="color: #222;">Não estou cadastrado</a>
                <?= $this->Form->button('Entrar', ['class' => 'btn-submit']) ?>
            </div>
        <?= $this->Form->end() ?>
    </div>
</body>
<script>
    $(document).ready(function () {
        $("#form_login").on("submit", function (event) {
            event.preventDefault();

            let validation = true;

            $(".form-register input").each(function () {
                if ($(this).val() === "") {
                    validation = false;
                    toastr.warning("Preencha todos os campos!");
                    return false;
                }
            });

            if (validation) {
                $(this).unbind("submit").submit();
            }
        });
    });
</script>
</html>
