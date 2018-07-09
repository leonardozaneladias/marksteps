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

                            $linkDelete = route('admin.user.destroy', ['user' => $model->id]);

                            $formDelete = FormBuilder::plain([
                                'id' => 'form-delete-'.$model->id,
                                'url' => $linkDelete,
                                 'method' => 'DELETE',
                                 'style' => 'display:none'
                            ]);



                            $linkEdit = route('admin.user.edit', ['user' => $model->id]);
                            $linkShow = route('admin.user.show', ['user' => $model->id]);
                            return form($formDelete).' '.Button::link("Editar")->asLinkTo($linkEdit).' | '.Button::link("Excluir")->asLinkTo($linkShow)->addAttributes([
                                'onclick' => 'event.preventDefault();document.getElementById("form-delete-'.$model->id.'").submit()'
                            ]);
                        })
                    !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
