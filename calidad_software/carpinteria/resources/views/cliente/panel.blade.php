<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Catálogo de Productos - Carpintería</title>
    <style>
        body {
            font-family: "Segoe UI", Arial, sans-serif;
            background: linear-gradient(135deg, #d2b48c, #8b5a2b);
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #5c4033;
            color: #fffaf0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 40px;
        }

        header h2 {
            margin: 0;
        }

        header a {
            color: #fffaf0;
            background-color: #a0522d;
            padding: 8px 14px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            transition: 0.3s;
        }

        header a:hover {
            background-color: #d2691e;
        }

        main {
            padding: 40px;
            background-color: #fffaf0;
            min-height: 100vh;
        }

        h3 {
            color: #5c4033;
            text-align: center;
            margin-bottom: 40px;
            border-bottom: 3px solid #a0522d;
            display: inline-block;
            padding-bottom: 8px;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 25px;
            justify-items: center;
        }

        .card {
            background-color: #fdf5e6;
            border: 1px solid #d2b48c;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.15);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            width: 250px;
            overflow: hidden;
        }

        .card:hover {
            transform: scale(1.04);
            box-shadow: 0 8px 18px rgba(0,0,0,0.25);
        }

        .card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-bottom: 3px solid #a0522d;
        }

        .card-content {
            padding: 15px;
        }

        .card-content h4 {
            margin: 8px 0;
            color: #5c4033;
            font-size: 18px;
        }

        .card-content p {
            margin: 6px 0;
            color: #654321;
            font-size: 14px;
        }

        .precio {
            font-weight: bold;
            color: #2e8b57;
            margin-top: 8px;
            font-size: 16px;
        }

        footer {
            margin-top: 40px;
            text-align: center;
            color: #fffaf0;
            font-size: 14px;
            padding: 15px;
            background-color: #5c4033;
        }

        .no-productos {
            text-align: center;
            color: #7a5c4a;
            font-style: italic;
            padding: 40px;
        }
    </style>
</head>
<body>
    <header>
        <h2>Bienvenido, Cliente</h2>
        <a href="{{ route('logout') }}">Cerrar sesión</a>
    </header>

    <main>
        <center><h3>Catálogo de Productos</h3></center>

        @if(count($productos) > 0)
        <div class="grid">
            @foreach($productos as $p)
                @php
                    $id = $p->id_producto;
                    $jpg = public_path("img/producto_{$id}.jpg");
                    $png = public_path("img/producto_{$id}.png");
                    $imagen = file_exists($jpg)
                        ? asset("img/producto_{$id}.jpg")
                        : (file_exists($png)
                            ? asset("img/producto_{$id}.png")
                            : asset('img/default.jpg'));
                @endphp

                <div class="card">
                    <img src="{{ $imagen }}" alt="Imagen de {{ $p->nombre }}">
                    <div class="card-content">
                        <h4>{{ $p->nombre }}</h4>
                        <p><strong>Tipo:</strong> {{ $p->nombre_tipo }}</p>
                        <p><strong>Material:</strong> {{ $p->material }}</p>
                        <p><strong>Descripción:</strong> {{ \Illuminate\Support\Str::limit($p->descripcion, 60, '...') }}</p>
                        <p class="precio">${{ number_format($p->precio, 0, ',', '.') }}</p>
                    </div>
                </div>
            @endforeach
        </div>
        @else
            <p class="no-productos">No hay productos disponibles por el momento.</p>
        @endif
    </main>

    <footer>
        © {{ date('Y') }} Carpintería | Catálogo de Productos
    </footer>
</body>
</html>
