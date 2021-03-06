@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8" style="padding-bottom:120px">
                <div class="card">
                    <div class="card-header">{{ __('Registro') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-3 col-form-label ">{{ __('Nombre(s)') }}</label>

                                <div class="col-md-8">
                                    <input id="name" type="text"
                                           class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                           name="name" value="{{ old('name') }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email"
                                       class="col-md-3 col-form-label ">{{ __('Correo electrónico') }}</label>

                                <div class="col-md-8">
                                    <input id="email" type="email"
                                           class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                           name="email" value="{{ old('email') }}" required>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password"
                                       class="col-md-3 col-form-label ">{{ __('Contraseña') }}</label>

                                <div class="col-md-8">
                                    <input id="password" type="password"
                                           class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                           name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-3 col-form-label ">{{ __('Confirmar
                                contraseña') }}</label>

                                <div class="col-md-8">
                                    <input id="password-confirm" type="password" class="form-control"
                                           name="password_confirmation"
                                           required>
                                </div>
                            </div>

                            <fieldset class="form-group">
                                <div class="row">
                                    <label class="col-md-3 col-form-label " for="gridRadios1">
                                        Perfil
                                    </label>
                                    <div class="col-12 offset-2 col-md-3 offset-md-1 my-1">
                                        <input type="radio"
                                               class="form-check-input{{ $errors->has('role') ? ' is-invalid' : '' }}"
                                               name="role" value="employee" required> Aspirante
                                    </div>
                                    <div class="col-12 offset-2 col-md-3 offset-md-0 my-1">
                                        <input type="radio"
                                               class="form-check-input{{ $errors->has('role') ? ' is-invalid' : '' }}"
                                               name="role" value="employer" required> Empresa
                                    </div>
                                </div>
                            </fieldset>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Registrar') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
