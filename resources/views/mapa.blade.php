@extends('layouts.app')

@section('content')
<div class="flex flex-col md:flex-row bg-gray-100" style="height: calc(100vh - 4rem)">
    <!-- Sidebar -->
    <div id="sidebar" class="w-full md:w-96 bg-gray-50 p-6 shadow-lg overflow-y-auto">
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Busca a tu Diputado</h1>
            <p class="text-gray-600">Encuentra información sobre tus representantes locales.</p>
        </div>

        <!-- Search Form -->
        <form id="search-form" class="mb-6">
            <label for="search-input" class="block text-sm font-medium text-gray-700 mb-1">Buscar por nombre, municipio o sección</label>
            <div class="relative">
                <input type="text" id="search-input" class="w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" placeholder="Ej: 'Maria', 'Tepic', '123'">
                <button type="submit" class="absolute inset-y-0 right-0 px-4 flex items-center bg-green-500 text-white rounded-r-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
        </form>

        <!-- Search Results -->
        <div id="search-results" class="mb-6"></div>

        <!-- Diputados RP List -->
        <div>
            <h2 class="text-2xl font-bold mb-4 text-gray-800 border-b-2 border-gray-200 pb-2">Diputados de R.P.</h2>
            <div id="diputados-rp-list" class="space-y-4">
                <!-- Data will be loaded here by JavaScript -->
            </div>
        </div>

        @auth
            @if(Auth::user()->role === 'admin')
                <div class="mt-8 border-t pt-6">
                    <a href="{{ route('admin.index') }}" class="w-full text-center bg-gray-700 hover:bg-gray-800 text-white font-bold py-2 px-4 rounded-lg shadow-lg transition duration-300 flex items-center justify-center space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                            <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
                        </svg>
                        <span>Editar Información</span>
                    </a>
                </div>
            @endif
        @endauth
    </div>

    <!-- Map -->
    <div id="map" class="flex-grow"></div>
</div>
@endsection

@push('styles')
<style>
    .district-label {
        background-color: transparent;
        border: none;
        box-shadow: none;
        font-weight: bold;
        font-size: 18px;
        color: white;
        text-shadow: 
            -1px -1px 0 #000,  
             1px -1px 0 #000,
            -1px  1px 0 #000,
             1px  1px 0 #000;
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Crear el mapa centrado en Nayarit
    const map = L.map('map').setView([21.8, -104.8], 8);

    // Límites máximos del mapa (Restringe la vista al área de Nayarit)
    const nayaritBounds = [[20.4, -106.0], [23.1, -103.5]];
    map.setMaxBounds(nayaritBounds);
    map.options.minZoom = 8; // Evita que se alejen demasiado

    // Capa base
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '© OpenStreetMap | Datos de Nayarit: H. Congreso del Estado de Nayarit'
    }).addTo(map);

    let diputados = {};

    // Cargar datos de diputados desde la API
    fetch('/api/diputados')
        .then(response => response.json())
        .then(data => {
            data.forEach(diputado => {
                diputados[diputado.distrito] = [diputado.nombre, diputado.enlace, diputado.imagen, diputado.municipios, diputado.type, diputado.partido, diputado.partido_color, diputado.partido_logo];
            });
            
            // Cargar GeoJSON después de tener los datos de los diputados
            fetch("{{ asset('distritos_locales_nayarit.geojson') }}")
              .then(res => res.json())
              .then(data => {
                geojson = L.geoJSON(data, {
                  style: style,
                  onEachFeature: onEachFeature
                }).addTo(map);

                const bounds = geojson.getBounds();
                map.fitBounds(bounds);
                map.setMaxBounds(bounds.pad(0.5));
              })
              .catch(error => {
                console.error('Error al cargar el GeoJSON:', error);
                alert('No se pudo cargar el archivo de distritos.');
              });
        })
        .catch(error => {
            console.error('Error al cargar los datos de los diputados:', error);
            alert('No se pudo cargar la información de los diputados.');
        });

    fetch('/api/diputados-rp')
        .then(response => response.json())
        .then(data => {
            const listContainer = document.getElementById('diputados-rp-list');
            listContainer.innerHTML = ''; // Clear any existing content
            data.forEach(diputado => {
                const card = document.createElement('div');
                card.className = 'bg-white p-3 rounded-lg shadow-sm border border-gray-200 flex items-center space-x-3';
                const imagen = diputado.imagen ? `{{ asset('images/diputados') }}/${diputado.imagen}` : `https://ui-avatars.com/api/?name=${encodeURIComponent(diputado.nombre)}&color=7F9CF5&background=EBF4FF`;
                const partidoLogo = diputado.partido_logo ? `<img src="{{ asset('images/partidos') }}/${diputado.partido_logo}" alt="${diputado.partido}" class="h-6 w-6 ml-2">` : '';
                card.innerHTML = `
                    <div class="flex-shrink-0">
                        <img class="h-12 w-12 rounded-full object-cover" src="${imagen}" alt="Avatar de ${diputado.nombre}">
                    </div>
                    <div class="flex-1 min-w-0">
                        <a href="${diputado.enlace}" target="_blank" class="text-sm font-semibold text-blue-600 hover:underline">
                            ${diputado.nombre}
                        </a>
                        <div class="flex items-center">
                            <p class="text-xs text-gray-500">Diputado de R.P.</p>
                            ${partidoLogo}
                        </div>
                    </div>
                `;
                listContainer.appendChild(card);
            });
        })
        .catch(error => {
            console.error('Error al cargar los datos de los diputados de R.P.:', error);
        });

    // Estilo por defecto institucional
    function style(feature) {
        const distrito = feature.properties.DISTRITO_L;
        const diputado = diputados[distrito];
        const color = diputado ? diputado[6] : '#66B3FF'; // Use party color or default
        return {
            fillColor: color,
            weight: 2,
            opacity: 1,
            color: '#004D99',
            dashArray: '3',
            fillOpacity: 0.3
        };
    }

    // Guarda una referencia al estilo inicial para la función resetHighlight
    let geojson;
    let info; 

    // Estilo de resaltado (Azul vibrante)
    function highlightFeature(e) {
        const layer = e.target;
        layer.setStyle({
            weight: 5,
            color: '#FFD700', // Oro vibrante
            dashArray: '',
            fillOpacity: 0.9
        });
        if (!L.Browser.ie && !L.Browser.opera && !L.Browser.edge) {
            layer.bringToFront();
        }
    }

    // Función para restablecer el estilo al quitar el ratón
    function resetHighlight(e) {
        geojson.resetStyle(e.target);
    }

    // Función para hacer zoom al distrito al hacer clic
    function zoomToFeature(e) {
        map.fitBounds(e.target.getBounds());
    }

    // Función principal para la interacción de cada distrito
    function onEachFeature(feature, layer) {
        const d = feature.properties.DISTRITO_L;
        const [nombre, link, imagenSrc, municipios, type, partido, partido_color, partido_logo] = diputados[d] || ["Información no disponible", "#", "", "", "", "", "", ""];
        
        const imagen = imagenSrc ? `{{ asset('images/diputados') }}/${imagenSrc}` : `https://ui-avatars.com/api/?name=${encodeURIComponent(nombre)}&color=7F9CF5&background=EBF4FF`;
        const partidoLogoImg = partido_logo ? `<img src="{{ asset('images/partidos') }}/${partido_logo}" alt="${partido}" class="h-8 w-8 absolute bottom-0 left-0 bg-white rounded-full p-1 shadow-md">` : '';

        let subtext = type === 'rp' 
            ? `<p class="text-sm font-semibold text-gray-600">Diputado de R.P.</p>` 
            : `<p class="text-sm font-semibold text-gray-600">Distrito ${d}</p><p class="text-xs text-gray-600 mb-2">Municipios: ${municipios || 'No especificado'}</p>`;

        // Contenido del Popup
        const popupContent = `
            <div class="text-center p-1">
                <div class="relative inline-block mb-2">
                    <div class="p-1 rounded-full" style="background-color: ${partido_color || 'transparent'}">
                        <img class="h-20 w-20 rounded-full object-cover shadow-md" src="${imagen}" alt="Avatar de ${nombre}">
                    </div>
                    ${partidoLogoImg}
                </div>
                <p class="text-xl font-bold text-gray-800 break-words">${nombre}</p>
                ${subtext}
                <a href="${link}" target="_blank" class="inline-block w-full bg-blue-300 text-black font-bold py-1 px-2 rounded-lg hover:bg-blue-400 transition text-sm">
                    Ver más
                </a>
            </div>
        `;
        layer.bindPopup(popupContent, { minWidth: 200 });

        // Tooltip para el número de distrito
        layer.bindTooltip("Distrito " + d, {
            permanent: true,
            direction: 'center',
            className: 'district-label bg-white bg-opacity-75 px-2 py-1 rounded-full'
        }).openTooltip();

        // Eventos de interacción
        layer.on({
            mouseover: highlightFeature,
            mouseout: resetHighlight,
            click: zoomToFeature
        });
    }

    // Search functionality
    const searchForm = document.getElementById('search-form');
    const searchInput = document.getElementById('search-input');
    const searchResults = document.getElementById('search-results');

    searchForm.addEventListener('submit', function (e) {
        e.preventDefault();
        const query = searchInput.value;
        searchResults.innerHTML = '<p class="text-gray-600 p-4">Buscando...</p>';

        if (!query) {
            searchResults.innerHTML = '';
            return;
        }

        fetch(`/api/diputados/search?query=${encodeURIComponent(query)}`)
            .then(response => response.json())
            .then(data => {
                searchResults.innerHTML = '';
                if (data.length) {
                    const title = document.createElement('h3');
                    title.className = 'text-xl font-bold mb-3 text-gray-800';
                    title.textContent = 'Resultados de Búsqueda';
                    searchResults.appendChild(title);

                    const list = document.createElement('div');
                    list.className = 'space-y-3';
                    data.forEach(diputado => {
                        const card = document.createElement('div');
                        card.className = 'bg-white p-3 rounded-lg shadow-sm border border-gray-200 cursor-pointer hover:shadow-md hover:border-blue-400 transition';
                        card.dataset.distrito = diputado.distrito;

                        const imagen = diputado.imagen ? `{{ asset('images/diputados') }}/${diputado.imagen}` : `https://ui-avatars.com/api/?name=${encodeURIComponent(diputado.nombre)}&color=7F9CF5&background=EBF4FF`;
                        const partidoLogo = diputado.partido_logo ? `<img src="{{ asset('images/partidos') }}/${diputado.partido_logo}" alt="${diputado.partido}" class="h-6 w-6 ml-2">` : '';
                        
                        let subtext = diputado.type === 'rp'
                            ? `<p class="text-sm text-gray-500">Diputado de R.P.</p>`
                            : `<p class="text-sm text-gray-500">Distrito ${diputado.distrito}</p>
                               <div class="mt-2 pl-4 border-l-2 border-gray-100">
                                   <p class="text-xs text-gray-600"><strong class="font-semibold">Municipios:</strong> ${diputado.municipios || 'No especificado'}</p>
                                   <p class="text-xs text-gray-600"><strong class="font-semibold">Secciones:</strong> ${diputado.secciones || 'No especificadas'}</p>
                               </div>`;

                        card.innerHTML = `
                            <div class="flex items-center space-x-3">
                                <div class="flex-shrink-0">
                                    <img class="h-14 w-14 rounded-full object-cover shadow-md" src="${imagen}" alt="Avatar de ${diputado.nombre}">
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center">
                                        <p class="text-md font-bold text-gray-800 truncate">${diputado.nombre}</p>
                                        ${partidoLogo}
                                    </div>
                                    ${subtext}
                                </div>
                            </div>
                        `;

                        card.addEventListener('click', function () {
                            // Reset style for all cards
                            document.querySelectorAll('#search-results .bg-white').forEach(c => {
                                c.classList.remove('border-blue-500', 'shadow-lg');
                                c.classList.add('border-gray-200');
                            });
                            // Apply style to clicked card
                            this.classList.add('border-blue-500', 'shadow-lg');
                            this.classList.remove('border-gray-200');


                            const distrito = this.dataset.distrito;
                            let found = false;
                            if (geojson) {
                                geojson.eachLayer(function (layer) {
                                    if (layer.feature.properties.DISTRITO_L == distrito) {
                                        zoomToFeature({ target: layer });
                                        layer.openPopup();
                                        highlightFeature({ target: layer });
                                        found = true;
                                    }
                                });
                            }
                            if (!found) {
                                alert('No se pudo encontrar el distrito en el mapa.');
                            }
                        });
                        list.appendChild(card);
                    });
                    searchResults.appendChild(list);
                } else {
                    searchResults.innerHTML = '<div class="text-center p-4 bg-gray-100 rounded-lg"><p class="font-semibold text-gray-700">No se encontraron resultados</p><p class="text-sm text-gray-500">Intenta con otro nombre, municipio o sección.</p></div>';
                }
            })
            .catch(error => {
                console.error('Error en la búsqueda:', error);
                searchResults.innerHTML = '<p class="text-red-500 p-4">Ocurrió un error al realizar la búsqueda. Por favor, inténtalo de nuevo.</p>';
            });
    });
});
</script>
@endpush