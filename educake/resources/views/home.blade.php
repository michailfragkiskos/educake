@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}
                        <button class="btn btn-outline-info btn-sm" @click="showforcast=!showforcast">Forcast</button>
                        <button class="btn btn-outline-info btn-sm" @click="showusers=!showusers">Users</button>
                    </div>
                    <users-component v-if="showusers"></users-component>
                    <forcast-component v-if="showforcast"></forcast-component>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
