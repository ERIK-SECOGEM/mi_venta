<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: sans-serif; text-align: center; }
        img { max-width: 250px; border-radius: 10px; }
    </style>
</head>
<body>

<h2>Ficha del Vehículo</h2>

<p><strong>Modelo:</strong> {{ $vehiculo->modelo }}</p>
<p><strong>Marca:</strong> {{ $vehiculo->marca }}</p>
<p><strong>Año:</strong> {{ $vehiculo->anio }}</p>

@if ($vehiculo->images)
    <img src="{{ public_path('storage/' . $vehiculo->images->first()->path) }}" alt="Vehículo">
@endif

<h3>Escanea el QR</h3>

<img src="data:image/png;base64,{{ $qr }}" alt="QR">

<p>o visita: {{ $url }}</p>

</body>
</html>