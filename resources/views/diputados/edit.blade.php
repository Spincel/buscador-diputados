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
                        <label for="nombre_{{ $diputado->id }}" class="block text-gray-700 text-sm font-bold mb-2 flex items-center">
                            <svg id="Capa_1" enable-background="new 0 0 512 512" height="16" viewBox="0 0 512 512" width="16" xmlns="http://www.w3.org/2000/svg" class="inline-block mr-1"><g><g><path d="m481.867 308.446-23.055-13.31c-11.074-6.397-17.585-18.43-17.05-31.215.232-5.243.232-10.601 0-15.844-.536-12.785 5.975-24.817 17.05-31.215l23.055-13.31c16.339-9.436 21.943-30.339 12.507-46.677l-33.337-57.752c-9.436-16.339-30.339-21.943-46.688-12.506l-23.045 13.31c-11.095 6.397-24.797 5.996-35.593-.876-4.45-2.843-9.035-5.491-13.732-7.943-11.322-5.913-18.471-17.575-18.471-30.349v-26.588c0-18.873-15.298-34.171-34.171-34.171h-66.673c-18.873 0-34.171 15.298-34.171 34.171v26.589c0 12.774-7.149 24.436-18.471 30.349-4.698 2.452-9.282 5.1-13.732 7.943-10.796 6.871-24.498 7.273-35.593-.876l-23.045-13.31c-16.349-9.437-37.252-3.832-46.688 12.506l-33.337 57.752c-9.436 16.339-3.832 37.241 12.507 46.677l23.055 13.31c11.074 6.397 17.585 18.43 17.05 31.215-.232 5.243-.232 10.601 0-15.844-.536-12.785 5.975-24.817 17.05-31.215l-23.055 13.31c-16.339 9.437-21.943 30.339-12.507 46.678l33.337 57.752c9.436 16.339 30.339 21.943 46.688 12.506l23.045-13.31c11.095-6.397 24.797-5.996 35.593.876 4.45 2.843 9.035 5.491 13.732 7.943 11.322 5.913 18.471 17.575 18.471 30.349v26.589c0 18.873 15.298 34.171 34.171 34.171h66.673c18.873 0 34.171-15.298 34.171-34.171v-26.59c0-12.774 7.149-24.436 18.471-30.349 4.698-2.452 9.282-5.1 13.732-7.943 10.796-6.871 24.498-7.273 35.593-.876l23.045 13.31c16.349 9.437 37.252 3.832 46.688-12.506l33.337-57.752c9.436-16.339 3.832-37.241-12.507-46.678zm-225.867 95.395c-81.652 0-147.841-66.189-147.841-147.841s66.189-147.841 147.841-147.841 147.841 66.189 147.841 147.841-66.189 147.841-147.841 147.841z" fill="#f8f6f9"/><g fill="#dddaec"><path d="m182.001 99.047c4.45-2.834 9.028-5.483 13.725-7.938 11.32-5.917 18.47-17.571 18.47-30.344v-26.591c0-18.874 15.3-34.174 34.174-34.174h-25.708c-18.874 0-34.174 15.3-34.174 34.174v26.591c0 12.773-7.151 24.428-18.47 30.344-4.697 2.455-9.275 5.104-13.725 7.938-1.829 1.165-3.746 2.128-5.714 2.92 10.225 4.164 21.939 3.119 31.422-2.92z"/><path d="m76.674 412.871-33.338-57.743c-9.437-16.345-3.837-37.245 12.509-46.682l23.053-13.31c11.075-6.394 17.58-18.432 17.043-31.21-.221-5.251-.221-10.604 0-15.854.537-12.777-5.968-24.815-17.043-31.21l-23.053-13.31c-16.345-9.435-21.945-30.336-12.508-46.681l33.338-57.743c3.958-6.856 9.936-11.812 16.746-14.57-15.565-6.344-33.813-.395-42.453 14.57l-33.338 57.743c-9.437 16.345-3.836 37.245 12.509 46.682l23.053 13.31c11.075 6.394 17.58 18.432 17.043 31.21-.222 5.251-.222 10.604 0 15.854.537 12.777-5.968 24.815-17.043 31.21l-23.053 13.31c-16.345 9.437-21.945 30.337-12.509 46.682l33.338 57.743c8.64 14.965 26.888 20.914 42.453 14.57-6.811-2.759-12.789-7.715-16.747-14.571z"/><path d="m214.196 477.826v-26.591c0-12.773-7.15-24.428-18.47-30.344-4.697-2.455-9.275-5.104-13.725-7.938-9.483-6.039-21.197-7.084-31.422-2.92 1.968.792 3.885 1.755 5.714 2.92 4.45 2.834 9.028 5.483 13.725 7.938 11.32 5.917 18.47 17.571 18.47 30.344v26.591c0 18.874 15.3 34.174 34.174 34.174h25.708c-18.874 0-34.174-15.3-34.174-34.174z"/></g></g><g><path d="m347.582 199.135c4.267-8.599.753-19.021-7.846-23.288l-26.907-13.328c-8.599-4.267-19.021-.753-23.288 7.846l-53.247 107.432-25.93-43.366c-4.927-8.243-15.587-10.924-23.83-5.997l-25.771 15.402c-8.229 4.927-10.924 15.587-5.997 23.83l51.094 85.464c3.263 5.455 9.247 8.705 15.587 8.454l36.22-1.427c6.354-.251 12.06-3.95 14.874-9.643z" fill="#95d6a4"/><g fill="#78c2a4"><path d="m247.125 295.912 62.225-125.547c1.388-2.797 3.433-5.044 5.848-6.672l-2.37-1.174c-8.599-4.267-19.021-.753-23.288 7.846l-53.247 107.432z"/><path d="m225.669 353.13-51.094-85.464c-4.927-8.243-2.232-18.903 5.997-23.83l24.737-14.784c-5.427-3.74-12.744-4.224-18.775-.618l-25.771 15.402c-8.229 4.927-10.924 15.587-5.997 23.83l51.094 85.464c3.263 5.455 9.247 8.705 15.587 8.454l14.678-.578c-4.311-1.149-8.096-3.931-10.456-7.876z"/></g></g></svg>
                            <span class="ml-1">Nombre:</span>
                        </label>
                        <input type="text" id="nombre_{{ $diputado->id }}" name="diputados[{{ $diputado->id }}][nombre]" value="{{ $diputado->nombre }}" class="block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 text-gray-700">
                    </div>
                    <div class="mb-4">
                        <label for="enlace_{{ $diputado->id }}" class="block text-gray-700 text-sm font-bold mb-2 flex items-center">
                            <svg id="Capa_1" enable-background="new 0 0 512 512" height="16" viewBox="0 0 512 512" width="16" xmlns="http://www.w3.org/2000/svg" class="inline-block mr-1"><g><path d="m494.853 112.473v358.91c0 22.43-18.186 40.616-40.616 40.616h-179.237l-173.747-29.37c-22.43 0-40.616 11.184-40.616-11.246v-430.764c0-22.43 18.186-40.616 40.616-40.616h281.129z" fill="#f8f6f9"/><path d="m125.229 482.63h-23.972c-22.427 0-40.619-18.182-40.619-40.619v-401.392c0-22.437 18.192-40.619 40.619-40.619h23.972c-22.437 0-40.619 18.182-40.619 40.619v401.391c-.001 22.437 18.182 40.62 40.619 40.62z" fill="#dddaec"/><path d="m494.853 112.473h-71.854c-22.43 0-40.616-18.186-40.616-40.616v-71.854" fill="#dddaec"/><path d="m231.299 233.076c0-39.695-32.179-71.874-71.874-71.874s-71.874 32.179-71.874 71.874c0 28.794 16.939 53.621 41.39 65.092v78.614h60.968v-78.614c24.451-11.47 41.39-36.297 41.39-65.092z" fill="#d8aa8b"/><path d="m127.448 233.076c0 28.793 7.539 53.621 18.417 65.09v78.614h-16.925v-78.614c-24.447-11.469-41.389-36.297-41.389-65.09 0-39.697 32.176-71.874 71.874-71.874-17.655.001-31.977 32.177-31.977 71.874z" fill="#ce9875"/><path d="m231.681 358.878h-141.845c-23.925 0-43.319 19.395-43.319 43.319v51.063l114.242 29.37 114.241-29.37v-51.063c0-23.924-19.394-43.319-43.319-43.319z" fill="#95d6a4"/><path d="m275 453.26h-228.483c-16.22 0-29.37 13.149-29.37 29.37 0 16.22 13.149 29.37 29.37 29.37h228.483c16.22 0 29.37-13.149 29.37-29.37 0-16.221-13.149-29.37-29.37-29.37z" fill="#407093"/><path d="m106.68 503.398c5.316 5.316 12.661 8.602 20.768 8.602h-80.93c-8.108 0-15.453-3.286-20.768-8.602-5.316-5.316-8.602-12.661-8.602-20.768 0-16.225 13.155-29.37 29.37-29.37h80.93c-16.215 0-29.37 13.145-29.37 29.37 0 8.107 3.286 15.452 8.602 20.768z" fill="#365e7d"/><path d="m139.861 358.879c-23.921 0-43.319 19.398-43.319 43.319v51.066h-50.025v-51.066c0-23.921 19.388-43.319 43.319-43.319z" fill="#78c2a4"/><path d="m445.596 201.103c3.777-7.612.667-16.839-6.946-20.616l-23.82-11.799c-7.612-3.777-16.839-.667-20.616 6.946l-47.136 95.103-22.954-38.39c-4.362-7.297-13.798-9.671-21.095-5.309l-22.814 13.635c-7.285 4.362-9.671 13.798-5.309 21.095l45.23 75.657c2.888 4.829 8.185 7.706 13.798 7.484l32.064-1.263c5.625-.222 10.676-3.496 13.167-8.536z" fill="#95d6a4"/></g></svg>
                            <span class="ml-1">Enlace:</span>
                        </label>
                        <input type="text" id="enlace_{{ $diputado->id }}" name="diputados[{{ $diputado->id }}][enlace]" value="{{ $diputado->enlace }}" class="block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 text-gray-700">
                    </div>
                    <div class="mb-4">
                        <label for="partido_{{ $diputado->id }}" class="block text-gray-700 text-sm font-bold mb-2 flex items-center">
                            <svg id="Capa_1" enable-background="new 0 0 512 512" height="16" viewBox="0 0 512 512" width="16" xmlns="http://www.w3.org/2000/svg" class="inline-block mr-1"><g><g><path d="m403.744 0h-283.316c-24.5 0-44.362 19.861-44.362 44.362v365.069c0 24.5 19.861 44.362 44.362 44.362h283.316c24.5 0 44.362-19.861 44.362-44.362v-365.069c0-24.5-19.862-44.362-44.362-44.362z" fill="#f8f6f9"/><path d="m144.769 453.79h-24.35c-24.49 0-44.35-19.86-44.35-44.35v-365.08c0-24.5 19.86-44.36 44.35-44.36h24.35c-24.5 0-44.36 19.86-44.36 44.36v365.08c0 24.49 19.86 44.35 44.36 44.35z" fill="#dddaec"/><path d="m448.108 187.916v221.519c0 24.497-19.862 44.36-44.36 44.36h-283.32c-24.498 0-44.359-19.862-44.359-44.36v-317.017c2.915-.371 5.882-.556 8.901-.556h146.368c24.621 0 47.46 12.867 60.214 33.924l15.144 24.992c12.764 21.057 35.593 33.924 60.214 33.924h60.121c7.345-.001 14.422 1.122 21.077 3.214z" fill="#dddaec"/><path d="m497.437 281.84v159.752c0 38.885-31.522 70.407-70.407 70.407h-342.06c-38.885 0-70.407-31.522-70.407-70.407v-252.584c0-38.885 31.522-70.407 70.407-70.407h146.367c24.623 0 47.456 12.863 60.216 33.922l15.141 24.989c12.76 21.059 35.593 33.922 60.216 33.922h60.119c38.885-.001 70.408 31.521 70.408 70.406z" fill="#dd636e"/><path d="m121.97 511.995h-37.004c-38.879 0-70.403-31.524-70.403-70.403v-252.59c0-38.889 31.524-70.403 70.403-70.403h37.004c-38.889 0-70.413 31.513-70.413 70.403v252.59c0 38.879 31.523 70.403 70.413 70.403z" fill="#da4a54"/></g><g><path d="m294.938 336.696 33.271-33.271c5.614-5.614 5.614-14.716 0-20.33l-18.608-18.608c-5.614-5.614-14.716-5.614-20.33 0l-33.271 33.271-33.271-33.271c-5.614-5.614-14.716-5.614-20.33 0l-18.608 18.608c-5.614 5.614-5.614 14.716 0 20.33l33.271 33.271-33.271 33.271c-5.614 5.614-5.614 14.716 0 20.33l18.608 18.608c5.614 5.614 14.716 5.614 20.33 0l33.271-33.271 33.271 33.271c5.614 5.614 14.716 5.614 20.33 0l18.608-18.608c5.614-5.614 5.614-14.716 0-20.33z" fill="#f8f6f9"/></g></g></svg>
                            <span class="ml-1">Partido:</span>
                        </label>
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
