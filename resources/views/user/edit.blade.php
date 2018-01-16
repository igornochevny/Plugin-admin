@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                {!! Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'PUT']) !!}
                {!! Form::label('Username', 'Username') !!}
                {!! Form::text('username', null, ['class' => 'form-control']) !!}
                {!! Form::button('Update', ['type' => 'submit', 'class' => 'btn btn-primary btn-form']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>

@endsection