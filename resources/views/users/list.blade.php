<x-app-layout>
    <x-slot name="header">
        <h3 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Utilisateurs') }}
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
                        <h1 class="inline">Liste des utilisateurs</h1>
                        @if(App\Utils\Helper::generalPolicieBool(Auth::user(),'create'))
                        <a class="inline btn btn-sm btn-primary float-right mr-1" href="{{ route('users.create') }}"><i class="fa fa-fw fa-edit"></i>Nouveu</a>
                        @endif
                    </div>
                    <hr class="my-3">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="thead">
                                <tr>
                                    <th>N°</th>
                                    <th>Nom</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Permissions</th>
                                    <th><span class="float-right mr-2"></span></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ ++$i }}</td>

                                        <td>{{ $user->name ?? ''}}</td>
                                        <td>{{ $user->email ?? '' }}</td>
                                        <td>{{ $user->role->libelle ?? '' }}</td>
                                        <td>
                                            @foreach ($user->permissions as $permission )
                                                {{$permission->libelle}},
                                            @endforeach
                                        </td>

                                        <td class="">
                                            <form action="{{ route('users.destroy',$user->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')

                                                @if(App\Utils\Helper::generalPolicieBool(Auth::user(),'delete'))
                                                <button type="submit" class="btn bg-danger btn-sm btn-danger float-right mr-1"><i class="fa fa-fw fa-trash"></i> Delete</button>
                                                @endif

                                                @if(App\Utils\Helper::generalPolicieBool(Auth::user(),'edit'))
                                                <a class="btn btn-sm btn-success float-right mr-1" href="{{ route('users.edit',$user->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
                                                @endif

                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
