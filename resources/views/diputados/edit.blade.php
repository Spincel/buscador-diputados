@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 bg-gray-100">
    <div class="flex justify-between items-center">
        <h1 class="text-3xl font-bold text-gray-800">Editar Información de Diputados</h1>
        <a href="{{ url('/mapa') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow-lg transition duration-300">
            Volver al Mapa
        </a>
    </div>

    <div class="mt-6 flex justify-center gap-4">
        <a href="{{ route('diputados.edit', ['type' => 'all']) }}" class="px-4 py-2 rounded-lg shadow-sm {{ $type === 'all' ? 'bg-blue-600 text-white' : 'bg-white text-gray-700 hover:bg-gray-200' }}">Todos</a>
        <a href="{{ route('diputados.edit', ['type' => 'distrito']) }}" class="px-4 py-2 rounded-lg shadow-sm {{ $type === 'distrito' ? 'bg-blue-600 text-white' : 'bg-white text-gray-700 hover:bg-gray-200' }}">Distrito</a>
        <a href="{{ route('diputados.edit', ['type' => 'rp']) }}" class="px-4 py-2 rounded-lg shadow-sm {{ $type === 'rp' ? 'bg-blue-600 text-white' : 'bg-white text-gray-700 hover:bg-gray-200' }}">R.P.</a>
    </div>

    <form action="{{ route('diputados.update') }}" method="POST" class="mt-6" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" name="type" value="{{ $type }}">

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($diputados as $diputado)
                <div class="bg-white p-6 rounded-lg shadow-lg transition duration-300 hover:shadow-xl hover:scale-102">
                    <h2 class="text-xl font-bold mb-4 text-gray-700">
                        @if ($diputado->type === 'rp')
                            {{ $diputado->nombre }}
                        @else
                            Distrito {{ $diputado->distrito }}
                        @endif
                    </h2>
                    <div class="mb-4">
                        <label for="nombre_{{ $diputado->id }}" class="block text-gray-700 text-sm font-bold mb-2">Nombre:</label>
                        <input type="text" id="nombre_{{ $diputado->id }}" name="diputados[{{ $diputado->id }}][nombre]" value="{{ $diputado->nombre }}" class="block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 text-gray-700">
                    </div>
                    <div class="mb-4">
                        <label for="enlace_{{ $diputado->id }}" class="block text-gray-700 text-sm font-bold mb-2">Enlace:</label>
                        <input type="text" id="enlace_{{ $diputado->id }}" name="diputados[{{ $diputado->id }}][enlace]" value="{{ $diputado->enlace }}" class="block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 text-gray-700">
                    </div>
                    <div class="mb-4">
                        <label for="partido_{{ $diputado->id }}" class="block text-gray-700 text-sm font-bold mb-2">Partido:</label>
                        <input type="text" id="partido_{{ $diputado->id }}" name="diputados[{{ $diputado->id }}][partido]" value="{{ $diputado->partido }}" class="block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 text-gray-700">
                    </div>
                    <div class="mb-4">
                        <label for="partido_color_{{ $diputado->id }}" class="block text-gray-700 text-sm font-bold mb-2">Color del Partido:</label>
                        <input type="color" id="partido_color_{{ $diputado->id }}" name="diputados[{{ $diputado->id }}][partido_color]" value="{{ $diputado->partido_color }}" class="block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 p-1 text-gray-700">
                    </div>
                    <div class="mb-4">
                        <label for="partido_logo_{{ $diputado->id }}" class="block text-gray-700 text-sm font-bold mb-2">Logo del Partido:</label>
                        <div id="partido_logo_dropzone_{{ $diputado->id }}" class="dropzone border-2 border-dashed border-gray-300 rounded-lg p-6 text-center cursor-pointer hover:border-blue-500 transition">
                            <input type="file" id="partido_logo_{{ $diputado->id }}" name="diputados[{{ $diputado->id }}][partido_logo]" class="hidden">
                            <div class="dz-message text-gray-500">
                                <p>Arrastra y suelta el logo aquí o haz clic para seleccionarlo</p>
                                <img src="{{ $diputado->partido_logo ? asset('images/partidos/' . $diputado->partido_logo) : '' }}" alt="Logo del partido" class="mt-2 w-16 h-16 object-contain mx-auto {{ $diputado->partido_logo ? '' : 'hidden' }}" id="partido_logo_preview_{{ $diputado->id }}">
                                <p id="partido_logo_filename_{{ $diputado->id }}" class="mt-2 text-sm font-semibold"></p>
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="imagen_{{ $diputado->id }}" class="block text-gray-700 text-sm font-bold mb-2">Imagen:</label>
                        <div id="imagen_dropzone_{{ $diputado->id }}" class="dropzone border-2 border-dashed border-gray-300 rounded-lg p-6 text-center cursor-pointer hover:border-blue-500 transition">
                            <input type="file" id="imagen_{{ $diputado->id }}" name="diputados[{{ $diputado->id }}][imagen]" class="hidden">
                            <div class="dz-message text-gray-500">
                                <p>Arrastra y suelta la imagen aquí o haz clic para seleccionarla</p>
                                <img src="{{ $diputado->imagen ? asset('images/diputados/' . $diputado->imagen) : '' }}" alt="Imagen del diputado" class="mt-2 w-32 h-32 object-cover rounded-md shadow-md mx-auto {{ $diputado->imagen ? '' : 'hidden' }}" id="imagen_preview_{{ $diputado->id }}">
                                <p id="imagen_filename_{{ $diputado->id }}" class="mt-2 text-sm font-semibold"></p>
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="secciones_{{ $diputado->id }}" class="block text-gray-700 text-sm font-bold mb-2">Secciones:</label>
                        <textarea id="secciones_{{ $diputado->id }}" name="diputados[{{ $diputado->id }}][secciones]" class="block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 text-gray-700">{{ $diputado->secciones }}</textarea>
                    </div>
                    <div class="mb-4">
                        <label for="municipios_{{ $diputado->id }}" class="block text-gray-700 text-sm font-bold mb-2">Municipios:</label>
                        <textarea id="municipios_{{ $diputado->id }}" name="diputados[{{ $diputado->id }}][municipios]" class="block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 text-gray-700">{{ $diputado->municipios }}</textarea>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="fixed bottom-8 right-8 z-50">
            <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-4 px-4 rounded-full shadow-lg transition duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                </svg>
            </button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const dropzones = document.querySelectorAll('.dropzone');

    dropzones.forEach(dropzone => {
        const input = dropzone.querySelector('input[type="file"]');
        const message = dropzone.querySelector('.dz-message');
        const preview = dropzone.querySelector('img');
        const filename = dropzone.querySelector('p[id$="_filename"]');

        dropzone.addEventListener('click', () => {
            input.click();
        });

        input.addEventListener('change', () => {
            if (input.files.length) {
                const file = input.files[0];
                const reader = new FileReader();
                reader.onload = (event) => {
                    preview.src = event.target.result;
                    preview.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
                filename.textContent = file.name;
            }
        });

        dropzone.addEventListener('dragover', (event) => {
            event.preventDefault();
            dropzone.classList.add('border-blue-500', 'bg-blue-50');
        });

        dropzone.addEventListener('dragleave', () => {
            dropzone.classList.remove('border-blue-500', 'bg-blue-50');
        });

        dropzone.addEventListener('drop', (event) => {
            event.preventDefault();
            dropzone.classList.remove('border-blue-500', 'bg-blue-50');
            if (event.dataTransfer.files.length) {
                input.files = event.dataTransfer.files;
                const file = input.files[0];
                const reader = new FileReader();
                reader.onload = (e) => {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
                filename.textContent = file.name;
            }
        });
    });
});
</script>
@endpush
