<?php

namespace MarkSteps\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Kris\LaravelFormBuilder\FormBuilder;
use MarkSteps\Forms\UserForm;
use MarkSteps\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate();
        return view('admin.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(UserForm::class, [
            'method' => 'POST',
            'url' => route('admin.user.store')
        ]);

        return view('admin.user.create', compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, FormBuilder $formBuilder)
    {
        /** @var Form $form */
        $form = $formBuilder->create(UserForm::class);
        if(!$form->isValid()){
            return redirect()
                ->back()
                ->withErrors($form->getErrors())
                ->withInput();
        }
        $data = $form->getFieldValues();
        $data['password'] = Hash::make($data['password']);
        $result = \MarkSteps\User::create($data);
        //$request->session()->flash('message', 'Usuário criado com sucesso');
        //$request->session()->flash('user_created', [
//            'id' => $result['user']->id,
//            'password' => $result['password']
//        ]);
        return redirect()->route('admin.users.show');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user, FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(UserForm::class, [
            'url' => route('admin.user.update', ['user' => $user->id]),
            'method' => 'PUT',
            'model' => $user
        ]);
        return view('admin.user.edit', compact('form'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(User $user)
    {
        /** @var Form $form */
        $form = \FormBuilder::create(UserForm::class, [
            'data' => ['id' => $user->id]
        ]);
        if(!$form->isValid()){
            return redirect()
                ->back()
                ->withErrors($form->getErrors())
                ->withInput();
        }
        $data = $form->getFieldValues();
        $user->update($data);
        //session()->flash('message', 'Usuário editado com sucesso');
        return redirect()->route('admin.user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
