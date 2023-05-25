<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Event\EventInterface;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    public function index()
    {
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
    }

    public function register()
    {
        $this->render('registrar_usuario');
    }

    public function login()
    {
        $this->render('login');
    }

    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('user'));
    }

    public function add()
    {
        $this->autoRender = false;

        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            $dados = [
                "nome_completo" => $this->request->getData('nome'),
                "email" => $this->request->getData('email'),
                "password" => password_hash($this->request->getData('password'), PASSWORD_DEFAULT),
                "created" => date('Y-m-d H:i:s'),
                "ativo" => 1
            ];

            $user = $this->Users->patchEntity($user, $dados);

            if ($this->Users->save($user)) {
                $this->Flash->success(__('
                    <script>
                        toastr.success("Cadastro realizado com sucesso!", {
                            closeButton: false,
                            timeOut: 3000,
                            progressBar: true
                        });
                    </script>'),
                    ['escape' => false]
                );

                return $this->redirect(['action' => 'authentication']);
            }
            $this->Flash->error(__('
                <script>
                    toastr.error("Erro ao realizar o cadastro! Tente novamente", {
                        closeButton: false,
                        timeOut: 3000,
                        progressBar: true
                    });
                </script>'),
                ['escape' => false]
            );

            return $this->redirect(['action' => 'register']);
        }
    }

    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function authentication()
    {
        if($this->request->is('post')) {
            $user = $this->Auth->identify();

            if ($user) {
                $this->Auth->setUser($user);

                return $this->redirect(['action' => 'home']);
            } else {
                $this->Flash->error(__(
                    '<script>
                        toastr.error("Usuário ou senha incorretos!", {
                            closeButton: false,
                            timeOut: 3000,
                            progressBar: true
                        });
                    </script>'),
                    ['escape' => false]
                );

                $this->redirect(['action' => 'register']);
            }
        }
    }

    public function logout()
    {
        $this->Flash->success(__(
            '<script>
                toastr.success("Logout realizado com sucesso!", {
                    closeButton: false,
                    timeOut: 3000,
                    progressBar: true
                });
            </script>'),
            ['escape' => false]
        );

        return $this->redirect($this->Auth->logout());
    }

    public function home()
    {
        $this->render('home');
    }

    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->Authentication->addUnauthenticatedActions(['login', 'register', 'authentication']);
        return $this->redirect(['action' => 'register']);
    }

    public function initialize(): void {
        parent::initialize();

        // $this->loadComponent('Authentication.Authentication', [
        //     'authenticate' => [
        //         'Form' => [
        //             'fields' => [
        //                 'username' => 'username',
        //                 'password' => 'password'
        //             ]
        //         ]
        //     ],
        //     'loginAction' => [
        //         'controller' => 'Users',
        //         'action' => 'home'
        //     ],
        //     'logoutRedirect' => [
        //         'controller' => 'Users',
        //         'action' => 'register'
        //     ],
        //     'authError' => 'Você não tem permissão para acessar essa página',
        // ]);
    }

}
