@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    User Create
                    <span style="float: right">{!! Button::primary('Novo Usuário')->asLinkTo(route('admin.user.create')) !!}</span>
                </div>

                <div class="card-body">
                    {!!
                        Table::withContents($users->items())
                        ->striped()
                        ->callback('Ações', function ($field, $model){
                            $linkEdit = route('admin.user.edit', ['user' => $model->id]);
                            $linkShow = route('admin.user.show', ['user' => $model->id]);
                            return Button::link("Editar")->asLinkTo($linkEdit).' | '.Button::link("Excluir")->asLinkTo($linkShow);
                        })
                    !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
