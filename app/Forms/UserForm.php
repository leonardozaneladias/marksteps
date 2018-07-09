<?php

namespace MarkSteps\Forms;

use Kris\LaravelFormBuilder\Form;

class UserForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('name', 'text')
            ->add('email', 'email')
            ->add('password', 'password')
            ->add('level', 'select');
    }
}
