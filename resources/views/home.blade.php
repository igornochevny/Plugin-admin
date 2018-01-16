@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @if(Session::has('message'))
            <div class="alert alert-success">
                {{ Session::get('message') }}
            </div>
        @endif
            <div class="title">
                <h2>Add new user</h2>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            {!! Form::open(['method'=>'POST', 'route' => 'users.store']) !!}
            {!! Form::label('Name', 'Name') !!}
            {!! Form::text('username', null, ['class' => 'form-control']) !!}
            {!! Form::button('Create', ['type' => 'submit', 'class' => 'btn btn-primary btn-form']) !!}
            {!! Form::close() !!}

            <div class="col-md-12">
                <table class="table table-responsive table-bordered">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Username</th>
                        <th>Secret key</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $key => $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->secret_key }}</td>
                            <td width="25%">
                                <form action="{{ URL('/users/'. $user->id) }}" method="POST">

                                    @if($user->is_activated)
                                        <a href="{{ URL('/users/'. $user->id .'/deactivate') }}" class="btn btn-sm btn-danger">Deactivate</a>
                                    @else
                                        <a href="{{ URL('/users/'. $user->id .'/activate') }}" class="btn btn-sm btn-success">Activate</a>
                                    @endif

                                    <a href="{{ URL('/users/'. $user->id .'/edit') }}" class="btn btn-sm btn-warning">Edit</a>

                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
    </div>
</div>
@endsection
