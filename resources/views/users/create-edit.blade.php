<x-app-layout>
    <x-slot name="header">
        <h3 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Utilisateurs') }}
        </h3>
    </x-slot>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="">
                        @isset($user)
                        <h1 class="inline">Modifier un utilisateur</h1>
                        @else
                        <h1 class="inline">Ajouter un utilisateur</h1>
                        @endif
                        <a class="inline btn btn-sm btn-primary float-right mr-1" href="{{ route('users.index') }}"><i class="fa fa-fw fa-edit"></i>Liste</a>
                    </div>
                    <hr class="my-3">
                    <div>
                        <x-auth-validation-errors class="mb-4" :errors="$errors" />
                    </div>
                    <div class="card-block">
                        @isset($user)
                            <form method="POST" action="{{ route('users.update', $user->id) }}">
                            @method('PATCH')
                        @else
                            <form method="POST" action="{{ route('users.store') }}">
                        @endif
                            {{csrf_field()}}
                            <!-- Nom -->
                            <div class="form-group row mb-3">
                                <label class="col-sm-2 col-form-label">Nom</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="name" value="{{old('name') ?? $user->name ?? '' }}" required="">
                                    @if( $errors->has('name'))
                                        <label class="col-sm-12 col-form-label text-danger">{{ $errors->first('name') }}</label>
                                    @endif
                                </div>
                            </div>

                            <!-- email -->
                            <div class="form-group row mb-3">
                                <label class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" name="email" value="{{old('email') ?? $user->email ?? '' }}" required="">
                                    @if( $errors->has('email'))
                                        <label class="col-sm-12 col-form-label text-danger">{{ $errors->first('email') }}</label>
                                    @endif
                                </div>
                            </div>

                            <!-- role -->
                            <div class="form-group row mb-3">
                                <label class="col-sm-2 col-form-label">Role</label>
                                <div class="col-sm-10">
                                    <select name="role_id" type="text" class="form-control" id="role_id">
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}" @selected(old('role_id') == $role->id)
                                                permissions="@foreach ($role->permissions as $permission){{$permission->id}},@endforeach"
                                                @isset($user)@if($role->id==$user->role_id) selected="" @endif @endif
                                            >
                                                {{ $role->libelle}}
                                            </option>
                                        @endforeach
                                    </select>

                                    @if( $errors->has('role'))
                                        <label class="col-sm-12 col-form-label text-danger">{{ $errors->first('role') }}</label>
                                    @endif
                                </div>
                            </div>

                            <!-- permissions -->
                            <div class="form-group row mb-3">
                                <label class="col-sm-2 col-form-label">Permissions</label>
                                <div class="col-sm-10">
                                    <select  type="text" name="permissions[]" class="chosen-select form-control" data-placeholder="Choisir les permissions..."  multiple>
                                        @foreach ($permissions as $permission)
                                            <option value="{{ $permission->id }}"
                                                @if (is_array(old('permissions')) && in_array($permission->id,old('permissions')))selected="" @endif
                                                @isset($user)@if(App\Utils\Helper::existPermissionUSer($permission->id, $user->id)) selected="" @endif @endif
                                            >
                                                {{ $permission->libelle}}
                                            </option>
                                        @endforeach
                                    </select>

                                    @if( $errors->has('permissions'))
                                        <label class="col-sm-12 col-form-label text-danger">{{ $errors->first('permissions') }}</label>
                                    @endif
                                </div>
                            </div>

                            @if(!isset($user))
                            <!-- password -->
                            <div class="form-group row mb-3">
                                <label class="col-sm-2 col-form-label">Mot de passe</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" name="password" value="{{old('password') ?? $user->password ?? '' }}" required="">
                                    @if( $errors->has('password'))
                                        <label class="col-sm-12 col-form-label text-danger">{{ $errors->first('password') }}</label>
                                    @endif
                                </div>
                            </div>

                            <!-- password_confirmation -->
                            <div class="form-group row mb-3">
                                <label class="col-sm-2 col-form-label">Confirmer le mot de passe</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" name="password_confirmation" value="{{old('password_confirmation') ?? $user->password_confirmation ?? '' }}" required="">
                                    @if( $errors->has('password_confirmation'))
                                        <label class="col-sm-12 col-form-label text-danger">{{ $errors->first('password_confirmation') }}</label>
                                    @endif
                                </div>
                            </div>
                            @endif

                            <!-- Button -->
                            <div class="form-group row">
                                <label class="col-sm-2"></label>
                                <div class="col-sm-10">
                                    <button type="reset" class="btn bg-danger btn-danger float-right m-b-0 reset">Réinitialiser</button>
                                    <button type="submit" class="btn bg-primary btn-primary float-right m-b-0 mr-1">Soumettre</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>
