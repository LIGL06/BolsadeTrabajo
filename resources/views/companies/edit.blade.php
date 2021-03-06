@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col" style="padding-bottom:120px">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                @if(Auth::user()->isEmployer() && Auth::user()->employer)
                    <div class="card">
                        <div class="card-header">Editar Empresa</div>
                        <div class="card-body">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-10 col-12">
                                        <h1>{{Auth::user()->employer->company->name}}</h1>
                                    </div>
                                </div>
                                {!! Form::model($user,['route' => ['companies.update', Auth::user()->employer->company->id], 'method'=>'put', 'files' => true]) !!}
                                <div class="row">
                                    <div class="col-md-4 col-12">
                                        <div class="text-center">
                                            <img class="avatar img-circle img-thumbnail" alt="avatar"
                                                 src={{Auth::user()->employer->company->bgPictureUrl}}>
                                            <h6>Subir un logo o foto...</h6>
                                            {{Form::file('image', ['class'=> 'text-center center-block file-upload'])}}
                                        </div>
                                    </div>
                                    <!--/col-sm-3-->
                                    <div class="col-lg-8 col-12">
                                        <div class="form-group row">
                                            <div class="col-md-6 col-12">
                                                <label for="fName"><h4>{{__('Nombre')}}</h4></label>
                                                {!! Form::text('name', Auth::user()->employer->company->name, ['class'=> 'form-control', 'placeholder' => 'Nombre de empresa']) !!}
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <label for="lName"><h4>{{__('Giro')}}</h4></label>
                                                {!! Form::text('rotation', Auth::user()->employer->company->rotation, ['class'=> 'form-control', 'placeholder' => 'Giro de empresa' ]) !!}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-6 col-12">
                                                <label for="fName"><h4>{{__('Teléfono')}}</h4></label>
                                                {!! Form::text('phone', Auth::user()->employer->company->phone, ['class'=> 'form-control','placeholder' => 'Teléfono de empresa']) !!}
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <label for="lName"><h4>{{__('Contacto')}}</h4></label>
                                                {!! Form::text('contact', Auth::user()->name, ['class'=> 'form-control','placeholder' => 'Contacto en empresa','readOnly'=>true]) !!}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-6 col-12">
                                                <label for="doB"><h4>{{ __('Correo electrónico') }}</h4></label>
                                                {!! Form::email('email', Auth::user()->employer->company->email, ['class'=> 'form-control','placeholder' => 'Email de empresa']) !!}
                                            </div>
                                            <div class="col-md-6">
                                                <label for="doB"><h4>{{ __('Dirección') }}</h4></label>
                                                {!! Form::text('address', Auth::user()->employer->company->address, ['class'=> 'form-control','placeholder' => 'Domicilio de empresa']) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <!--/col-sm-9-->
                                </div><!--/row-->
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group row">
                                            <div class="col-md-6 col-12">
                                                <label for="doB"><h4>{{ __('Observaciones') }}</h4></label>
                                                {!! Form::text('observations', Auth::user()->employer->company->observations, ['class'=> 'form-control','placeholder' => 'Observaciones de empresa']) !!}
                                            </div>

                                        </div>
                                    </div>
                                    <!--/col-sm-12-->
                                    <div class="col-md-12 col-12">
                                        {!! Form::submit('Editar empresa',['class' => 'btn btn-lg btn-success float-right']) !!}
                                    </div>
                                </div>
                                {!! Form::close() !!}
                            </div>
                            @if(Auth::user()->employer->company->parent)
                                <hr>
                                <div class="container">
                                    <div class="row">
                                        <h3 class="mx-auto">FRANQUICIAS</h3>
                                        <div class="col-md-12 col-12 pre-scrollable">
                                            @foreach(Auth::user()->employer->company->companies as $company)
                                                <div class="col-md-12">
                                                    <div>
                                                        {!! Form::model($company, ['route'=> ['companies.update', $company->id], 'method'=>'put', 'files' => true]) !!}
                                                        <div class="row">
                                                            <div class="col-md-4 col-12">
                                                                <small for="fName"><h4>{{__($company->name)}}</h4>
                                                                </small>
                                                                <div class="text-center">
                                                                    <img class="companyAvatar img-circle img-thumbnail"
                                                                         alt="avatar"
                                                                         src={{$company->bgPictureUrl}}>
                                                                    <h6>Subir un logo o foto...</h6>
                                                                    {{Form::file('image', ['class'=> 'text-center center-block companyAvatarUpload'])}}
                                                                </div>
                                                            </div>
                                                            <!--/col-sm-3-->
                                                            <div class="col-md-8 col-12">
                                                                <div class="form-group row">
                                                                    <div class="col-md-6 col-12">
                                                                        <small for="fName"><h4>{{__('Nombre')}}</h4>
                                                                        </small>
                                                                        {!! Form::text('name', $company->name, ['class'=> 'form-control', 'placeholder' => 'Nombre de empresa']) !!}
                                                                    </div>
                                                                    <div class="col-md-6 col-12">
                                                                        <small for="lName"><h4>{{__('Giro')}}</h4>
                                                                        </small>
                                                                        {!! Form::text('rotation', $company->rotation, ['class'=> 'form-control', 'placeholder' => 'Giro de empresa' ]) !!}
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <div class="col-md-6 col-12">
                                                                        <small for="fName"><h4>{{__('Teléfono')}}</h4>
                                                                        </small>
                                                                        {!! Form::text('phone', $company->phone, ['class'=> 'form-control','placeholder' => 'Teléfono de empresa']) !!}
                                                                    </div>
                                                                    <div class="col-md-6 col-12">
                                                                        <small for="lName"><h4>{{__('Contacto')}}</h4>
                                                                        </small>
                                                                        {!! Form::text('contact', Auth::user()->name, ['class'=> 'form-control','placeholder' => 'Contacto en empresa','readOnly'=>true]) !!}
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <div class="col-md-6 col-12">
                                                                        <small for="doB">
                                                                            <h4>{{ __('Correo electrónico') }}</h4>
                                                                        </small>
                                                                        {!! Form::email('email', $company->email, ['class'=> 'form-control','placeholder' => 'Email de empresa']) !!}
                                                                    </div>
                                                                    <div class="col-md-6 col-12">
                                                                        <small for="doB"><h4>{{ __('Dirección') }}</h4>
                                                                        </small>
                                                                        {!! Form::text('address', $company->address, ['class'=> 'form-control','placeholder' => 'Domicilio de empresa']) !!}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!--/col-sm-9-->
                                                        </div><!--/row-->
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group row">
                                                                    <div class="col-md-6">
                                                                        <small for="doB">
                                                                            <h4>{{ __('Observaciones') }}</h4></small>
                                                                        {!! Form::text('observations', $company->observations, ['class'=> 'form-control','placeholder' => 'Observaciones de empresa']) !!}
                                                                    </div>

                                                                </div>
                                                            </div>
                                                            <!--/col-sm-12-->
                                                            <div class="col-md-12">
                                                                {!! Form::submit('Editar franquicia',['class' => 'btn btn-sm btn-primary float-right']) !!}
                                                            </div>
                                                        </div>
                                                        {!! Form::hidden('parentId', Auth::user()->employer->company->id) !!}
                                                        {!! Form::hidden('parent', 0) !!}
                                                        {!! Form::close() !!}
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <h3 class="mx-auto">Crear franquicia</h3>
                                        <div class="col-md-12 col-12 mx-auto pre-scrollable">
                                            <div>
                                                {!! Form::open(['route'=>'companies.store']) !!}
                                                <div class="form-group row">
                                                    <small class="col-sm-2 ">Nombre</small>
                                                    <div class="col-sm-10">
                                                        {!! Form::text('name', null, ['class'=> 'form-control', 'placeholder' => 'Nombre de franquicia', 'required' => true]) !!}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <small class="col-sm-2 ">Giro</small>
                                                    <div class="col-sm-10">
                                                        {!! Form::text('rotation', null, ['class'=> 'form-control', 'placeholder' => 'Giro de franquicia', 'required' => true ]) !!}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <small class="col-sm-2 ">Teléfono</small>
                                                    <div class="col-sm-10">
                                                        {!! Form::text('phone', null, ['class'=> 'form-control','placeholder' => 'Teléfono de franquicia', 'required' => true]) !!}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <small class="col-sm-2 ">Correo electrónico</small>
                                                    <div class="col-sm-10">
                                                        {!! Form::email('email', Auth::user()->email, ['class'=> 'form-control','placeholder' => 'Email de franquicia', 'required' => true]) !!}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <small class="col-sm-2 ">Dirección</small>
                                                    <div class="col-sm-10">
                                                        {!! Form::text('address', null, ['class'=> 'form-control','placeholder' => 'Domicilio de franquicia', 'required' => true]) !!}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <small class="col-sm-2 ">Observaciones</small>
                                                    <div class="col-sm-10">
                                                        {!! Form::text('observations', null, ['class'=> 'form-control','placeholder' => 'Observaciones de franquicia', 'required' => true]) !!}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <small class="col-sm-2 ">Contacto</small>
                                                    <div class="col-sm-10">
                                                        {!! Form::text('contact', Auth::user()->name, ['class'=> 'form-control','placeholder' => 'Contacto en franquicia', 'required' => true]) !!}
                                                    </div>
                                                </div>
                                                {!! Form::hidden('parentId', Auth::user()->employer->company->id) !!}
                                                {!! Form::hidden('parent', 0) !!}
                                                <div class="form-group row">
                                                    <small class="col-sm-2">Antecedentes no penales</small>
                                                    <div class="col-sm-10">
                                                        <div class="form-check">
                                                            {!! Form::checkbox('noPenalties', '1', true) !!}
                                                            <p>
                                                                Se solicita carta de antecedentes no penales
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                {!! Form::submit('Crear franquicia',['class' => 'btn btn-lg btn-primary float-right']) !!}
                                                {!! Form::close() !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @else
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <h1 class="display-4">Crear empresa</h1>
                                <div>
                                    {!! Form::open(['route'=>'companies.store']) !!}
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Nombre</label>
                                        <div class="col-sm-10">
                                            {!! Form::text('name', null, ['class'=> 'form-control', 'placeholder' => 'Nombre de empresa']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Giro</label>
                                        <div class="col-sm-10">
                                            {!! Form::text('rotation', null, ['class'=> 'form-control', 'placeholder' => 'Giro de empresa' ]) !!}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Teléfono</label>
                                        <div class="col-sm-10">
                                            {!! Form::text('phone', null, ['class'=> 'form-control','placeholder' => 'Teléfono de empresa']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Correo electrónico</label>
                                        <div class="col-sm-10">
                                            {!! Form::email('email', null, ['class'=> 'form-control','placeholder' => 'Email de empresa']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Dirección</label>
                                        <div class="col-sm-10">
                                            {!! Form::text('address', null, ['class'=> 'form-control','placeholder' => 'Domicilio de empresa']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Observaciones</label>
                                        <div class="col-sm-10">
                                            {!! Form::text('observations', null, ['class'=> 'form-control','placeholder' => 'Observaciones de empresa']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Contacto</label>
                                        <div class="col-sm-10">
                                            {!! Form::text('contact', Auth::user()->name, ['class'=> 'form-control','placeholder' => 'Contacto en empresa']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-2">Empresa raíz</div>
                                        <div class="col-sm-10">
                                            <div class="form-check">
                                                {!! Form::checkbox('parent', '1', true) !!}
                                                <label class="form-check-label">
                                                    Es una firma que tiene varias marcas
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-2">Antecedentes no penales</div>
                                        <div class="col-sm-10">
                                            <div class="form-check">
                                                {!! Form::checkbox('noPenalties', '1', true) !!}
                                                <label class="form-check-label">
                                                    Se solicita carta de antecedentes no penales
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-10">
                                            <button type="submit" class="btn btn-primary">Guardar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection