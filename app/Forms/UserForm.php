<?php

namespace MarkSteps\Forms;

use Kris\LaravelFormBuilder\Form;
use MarkSteps\User;

class UserForm extends Form
{
    public function buildForm()
    {
        $id = $this->getData('id');
        $this
            ->add('name', 'text', [
                'label' => 'Nome',
                'rules' => 'required|max:20'
            ])
            ->add('email', 'email', [
                'label' => 'E-mail',
                'rules' => "required|max:80|unique:users,email,{$id}"
            ])
            ->add('level', 'select', [
                'label' => 'Tipo de usuário',
                'choices' => $this->roles(),
                'rules' => 'required|in:'.implode(',', array_keys($this->roles())),
            ])
            ->add('password', 'password', [
                'label' => 'Senha',
                'rules' => "required|max:15"
            ]);
    }

    protected function roles()
    {
        return [
            User::ROLE_ADMIN => 'Administrador',
            User::ROLE_SUPER => 'Supervisor',
            User::ROLE_OPERATOR => 'Operador',
        ];
    }
}
