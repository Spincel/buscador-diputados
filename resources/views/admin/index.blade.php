@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 bg-gray-100">
    <div class="flex justify-between items-center">
        <h1 class="text-3xl font-bold text-gray-800">Panel de Administración</h1>
        <a href="{{ url('/mapa') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow-lg transition duration-300">
            Volver al Mapa
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
        <!-- User Management -->
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-xl font-bold mb-4 text-gray-700">Gestionar Usuarios</h2>
            <h3 class="text-lg font-semibold mb-2 text-gray-600">Usuarios Existentes</h3>
            <ul class="list-disc list-inside mb-4">
                @foreach ($users as $user)
                    <li>{{ $user->name }} ({{ $user->email }}) - {{ $user->role }}</li>
                @endforeach
            </ul>

            <h3 class="text-lg font-semibold mb-2 text-gray-600">Agregar Nuevo Usuario</h3>
            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Nombre:</label>
                    <input type="text" id="name" name="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
                    <input type="email" id="email" name="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Contraseña:</label>
                    <input type="password" id="password" name="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>
                <div class="mb-4">
                    <label for="role" class="block text-gray-700 text-sm font-bold mb-2">Rol:</label>
                    <select id="role" name="role" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <option value="user">Usuario</option>
                        <option value="admin">Administrador</option>
                    </select>
                </div>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow-lg transition duration-300">
                    Crear Usuario
                </button>
            </form>
        </div>

        <!-- Diputado Management -->
        <div class="bg-white p-6 rounded-lg shadow-lg" x-data="{ tab: 'manual' }">
            <h2 class="text-xl font-bold mb-4 text-gray-700">Gestionar Diputados</h2>

            <div class="border-b border-gray-200">
                <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                    <button @click="tab = 'manual'" :class="{ 'border-blue-500 text-blue-600': tab === 'manual', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': tab !== 'manual' }" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                        Editar Manualmente
                    </button>
                    <button @click="tab = 'import'" :class="{ 'border-blue-500 text-blue-600': tab === 'import', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': tab !== 'import' }" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                        Importar desde CSV
                    </button>
                </nav>
            </div>

            <div x-show="tab === 'manual'" class="mt-6">
                <p class="text-sm text-gray-600 mb-4">Selecciona un grupo de diputados para editar:</p>
                <div class="flex space-x-4">
                    <a href="{{ route('diputados.edit', ['type' => 'distrito']) }}" class="flex-1 text-center bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded shadow-lg transition duration-300">
                        Editar Diputados de Distrito
                    </a>
                    <a href="{{ route('diputados.edit', ['type' => 'rp']) }}" class="flex-1 text-center bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded shadow-lg transition duration-300">
                        Editar Diputados de R.P.
                    </a>
                </div>
                <a href="{{ route('diputados.edit', ['type' => 'all']) }}" class="mt-4 w-full text-center bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded shadow-lg transition duration-300 inline-block">
                    Editar Todos
                </a>
            </div>

            <div x-show="tab === 'import'" class="mt-6">
                <h3 class="text-lg font-semibold mb-2 text-gray-600">Importar Diputados desde CSV</h3>
                <p class="text-sm text-gray-600 mb-2">El archivo CSV debe tener las siguientes columnas: distrito, nombre, enlace, imagen, secciones, municipios.</p>
                <form action="{{ route('diputados.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label for="file" class="block text-gray-700 text-sm font-bold mb-2">Archivo CSV:</label>
                        <input type="file" id="file" name="file" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow-lg transition duration-300">
                        Importar CSV
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
