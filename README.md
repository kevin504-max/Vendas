### Projeto de Vendas com CakePHP

Construir uma aplicação web com CakePHP (versão 3.9), para realizar a Venda
de Itens para Pessoas. Cada Venda, deve ser composta por um comprador (Pessoa), um
vendedor (Pessoa) e deve haver no mínimo 1 Item nessa Venda.

### Comandos utilizados
```bash
    bin/cake server
    bin/cake bake migration create_produtos
    bin/cake bake model Produtos
    bin/cake bake controller Produtos
    bin/cake bake migration create_users
    bin/cake bake model User
    bin/cake bake controller User
    composer require cakephp/authentication
```
