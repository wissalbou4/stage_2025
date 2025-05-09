@extends('layouts.app')

@section('content')
<div class="container">
    
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p>Bienvenue <strong>{{ $user->name }}</strong> !</p>
                    
                    
</div>
@endsection
