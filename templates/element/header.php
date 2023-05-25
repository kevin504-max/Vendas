<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?= $this->Html->css('header.css') ?>
</head>
<body>
    <header>
        <nav class="navbar">
            <h1><a href="#"><img src="<?= $this->Url->image('logo.png') ?>" alt="Logo"></a></h1>
            <h1 class="welcome">Bem vindo(a) - <span>Sistema de Vendas!</span></h1>
            <div id="sidebar">
                <ul>
                    <li>
                        <a href="<?= $this->Url->build('/produtos/index') ?>">
                            <ion-icon name="fast-food-outline"></ion-icon>
                            <span>Gestão de Produtos</span>
                        </a>
                    </li>
                    <li>
                        <!-- <a href="<?= $this->Url->build('/users/index') ?>"> -->
                        <a href="#">
                        <ion-icon name="people-outline"></ion-icon>
                        <span>Gestão de Usuários</span>
                        </a>
                    </li>
                    <li>
                        <!-- <a href="<?= $this->Url->build('/index') ?>"> -->
                        <a href="#">
                            <ion-icon name="cash-outline"></ion-icon>
                            <span>Gestão de Vendas</span>
                        </a>
                    </li>
                    <li>
                        <!-- <a href="<?= $this->Url->build('/users/logout') ?>"> -->
                        <a href="#">
                            <ion-icon name="exit-outline"></ion-icon>
                            <span>Sair do sistema</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
</body>
</html>
