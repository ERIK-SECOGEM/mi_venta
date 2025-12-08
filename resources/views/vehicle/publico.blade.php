<h1>{{ $vehiculo->marca }} - {{ $vehiculo->modelo }}</h1>
<p>Año: {{ $vehiculo->anio }}</p>
@if ($vehiculo->imagen)
    <img src="{{ asset('storage/'.$vehiculo->imagen) }}" width="300">
@endif