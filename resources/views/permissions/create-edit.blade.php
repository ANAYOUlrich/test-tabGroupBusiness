<x-app-layout>
    <x-slot name="header">
        <h3 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Permissions') }}
        </h2>
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
                        @isset($permission)
                        <h1 class="inline">Modifier une permission</h1>
                        @else
                        <h1 class="inline">Ajouter une permission</h1>
                        @endif
                        <a class="inline btn btn-sm btn-primary float-right mr-1" href="{{ route('permissions.index') }}"><i class="fa fa-fw fa-edit"></i>Liste</a>
                    </div>
                    <hr class="my-3">
                    <div>
                        <x-auth-validation-errors class="mb-4" :errors="$errors" />
                    </div>
                    <div class="card-block">
                        @isset($permission)
                            <form method="POST" action="{{ route('permissions.update', $permission->id) }}">
                            @method('PATCH')
                        @else
                            <form method="POST" action="{{ route('permissions.store') }}">
                        @endif
                            {{csrf_field()}}
                            <!-- Nom -->
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Libelle</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="libelle" value="{{old('libelle') ?? $permission->libelle ?? '' }}" required="">
                                    @if( $errors->has('libelle'))
                                        <label class="col-sm-12 col-form-label text-danger">{{ $errors->first('libelle') }}</label>
                                    @endif
                                </div>
                            </div>

                            <!-- Button -->
                            <div class="form-group row mt-3">
                                <label class="col-sm-2"></label>
                                <div class="col-sm-10">
                                    <button type="reset" class="btn bg-danger btn-danger float-right m-b-0">Réinitialiser</button>
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
