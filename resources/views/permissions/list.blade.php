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
                        <h1 class="inline">Liste des permissions</h1>
                        <a class="inline btn btn-sm btn-primary float-right mr-1" href="{{ route('permissions.create') }}"><i class="fa fa-fw fa-edit"></i>Nouveu</a>
                    </div>
                    <hr class="my-3">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="thead">
                                <tr>
                                    <th>No</th>

                                    <th>Libelle</th>

                                    <th><span class="float-right mr-2"></span></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($permissions as $permission)
                                    <tr>
                                        <td>{{ ++$i }}</td>

                                        <td>{{ $permission->libelle }}</td>

                                        <td class="">
                                            <form action="{{ route('permissions.destroy',$permission->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn bg-danger btn-sm btn-danger float-right mr-1"><i class="fa fa-fw fa-trash"></i> Delete</button>
                                                <a class="btn btn-sm btn-success float-right mr-1" href="{{ route('permissions.edit',$permission->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
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
