<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Produtos Controller
 *
 * @property \App\Model\Table\ProdutosTable $Produtos
 * @method \App\Model\Entity\Produto[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProdutosController extends AppController
{
    public function index()
    {
        $produtos = $this->paginate($this->Produtos);

        $this->set(compact('produtos'));
    }

    public function view($id = null)
    {
        $produto = $this->Produtos->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('produto'));
    }

    public function register()
    {
        $this->render('registrar_produto');
    }

    public function add()
    {
        $this->autoRender = false;
        $produto = $this->Produtos->newEmptyEntity();

        if ($this->request->is('post')) {
            $preco = str_replace('.', '', $this->request->getData('preco'));
            $preco = str_replace(',', '.', $preco);

            $dados = [
                'nome' => $this->request->getData('nome'),
                'unidade_medida' => $this->request->getData('unidade'),
                'quantidade' => $this->request->getData('quantidade') ?? null,
                'preco' => floatVal($preco),
                'produto_perecivel' => $this->request->getData('perecivel'),
                'data_validade' => $this->request->getData('validade') ?? null,
                'data_fabricacao' => $this->request->getData('fabricacao')
            ];

            $produto = $this->Produtos->patchEntity($produto, $dados);
            if ($this->Produtos->save($produto)) {
                $this->Flash->success(__(
                    '<script>
                        toastr.success("Produto registrado com sucesso!", {
                            closeButton: false,
                            timeOut: 3000,
                            progressBar: true,
                            positionClass: "toast-top-right"
                        });
                    </script>'),
                    ['escape' => false]
                );
                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error(__(
                '<script>
                    toastr.error("Erro ao registrar produto! Tente novamente.", {
                        closeButton: false,
                        timeOut: 3000,
                        progressBar: true,
                        positionClass: "toast-top-right"
                    });
                </script>'),
                ['escape' => false]
            );
            return $this->redirect(['action' => 'register']);
        }
    }

    public function update($id = null)
    {
        $produto = $this->Produtos->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('produto'));

        $this->render('editar_produto');
    }

    public function edit()
    {
        $this->autoRender = false;

        $preco = str_replace('.', '', $this->request->getData('preco'));
        $preco = str_replace(',', '.', $preco);

        $dados = [
            'nome' => $this->request->getData('nome'),
            'unidade_medida' => $this->request->getData('unidade'),
            'quantidade' => $this->request->getData('quantidade') ?? null,
            'preco' => $preco,
            'produto_perecivel' => $this->request->getData('perecivel'),
            'data_validade' => $this->request->getData('validade') ?? null,
            'data_fabricacao' => $this->request->getData('fabricacao')
        ];

        $produto = $this->Produtos->get($this->request->getData('id'), [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $produto = $this->Produtos->patchEntity($produto, $dados);
            if ($this->Produtos->save($produto)) {
                $this->Flash->success(__(
                    '<script>
                        toastr.success("Produto atualizado com sucesso!", {
                            closeButton: false,
                            timeOut: 3000,
                            progressBar: true,
                            positionClass: "toast-top-right"
                        });
                    </script>'),
                    ['escape' => false]
                );

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__(
                '<script>
                    toastr.error("Erro ao atualizar produto! Tente novamente.", {
                        closeButton: false,
                        timeOut: 3000,
                        progressBar: true,
                        positionClass: "toast-top-right"
                    });
                </script>'),
                ['escape' => false]
            );        }
            $this->redirect(['action' => 'update', $produto->id]);
    }

    public function delete()
    {
        $this->request->allowMethod(['post', 'delete']);
        $produto = $this->Produtos->get($this->request->getData('id'));
        if ($this->Produtos->delete($produto)) {
            $this->Flash->success(__(
                '<script>
                    toastr.success("Produto excluído com sucesso!", {
                        closeButton: false,
                        timeOut: 3000,
                        progressBar: true,
                        positionClass: "toast-top-right"
                    });
                 </script>'),
                ['escape' => false]
            );
        } else {
            $this->Flash->error(__(
                '<script>
                    toastr.error("Erro ao excluir produto! Tente novamente.", "Erro", {
                        "timeOut": 3000,
                        "progressBar": true,
                        "positionClass": "toast-top-right"
                    });
                </script>'),
                ['escape' => false]
            );
        }

        return $this->redirect(['action' => 'index']);
    }

    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('Security');
    }
}
