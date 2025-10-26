<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel del Administrador - Carpintería</title>
    <style>
        /* === Estilo general === */
        body {
            font-family: "Segoe UI", Arial, sans-serif;
            background: linear-gradient(135deg, #d2b48c, #8b5a2b);
            margin: 0;
            padding: 0;
        }

        /* === Encabezado === */
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
            font-size: 22px;
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

        /* === Contenido principal === */
        main {
            margin: 40px auto;
            background: #fffaf0;
            border-radius: 15px;
            padding: 30px;
            width: 90%;
            max-width: 1400px; /* ampliado para caber la descripción */
            box-shadow: 0 5px 20px rgba(0,0,0,0.2);
        }

        h3 {
            color: #5c4033;
            border-bottom: 3px solid #a0522d;
            padding-bottom: 8px;
            margin-bottom: 25px;
        }

        /* === Botón de crear === */
        .btn-crear {
            display: inline-block;
            background-color: #2e8b57;
            color: white;
            padding: 10px 15px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            margin-bottom: 15px;
            transition: 0.3s;
        }

        .btn-crear:hover {
            background-color: #3cb371;
            transform: scale(1.05);
        }

        /* === Tabla === */
        .table-wrap {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 15px;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            min-width: 1100px;
        }

        thead {
            background-color: #a0522d;
            color: white;
        }

        th, td {
            padding: 12px 10px;
            text-align: center;
            border-bottom: 1px solid #ddd;
            vertical-align: middle;
        }

        th.desc, td.desc {
            text-align: left;
            max-width: 420px;
            word-wrap: break-word;
        }

        tr:nth-child(even) {
            background-color: #f9f4ee;
        }

        tr:hover {
            background-color: #f1e2d0;
            transition: 0.2s;
        }

        /* === Botones de acciones === */
        .acciones {
            display: flex;
            justify-content: center;
            gap: 10px;
            align-items: center;
        }

        .btn-ver {
            background-color: #4682b4;
            color: white;
            padding: 6px 10px;
            border-radius: 4px;
            text-decoration: none;
            transition: 0.3s;
        }
        .btn-ver:hover {
            background-color: #5da0d1;
        }

        .btn-editar {
            background-color: #daa520;
            color: white;
            padding: 6px 10px;
            border-radius: 4px;
            text-decoration: none;
            transition: 0.3s;
        }
        .btn-editar:hover {
            background-color: #ffbf00;
        }

        .btn-eliminar {
            background-color: #b22222;
            color: white;
            padding: 6px 10px;
            border-radius: 4px;
            border: none;
            cursor: pointer;
            transition: 0.3s;
        }
        .btn-eliminar:hover {
            background-color: #dc143c;
        }

        /* === Mensaje cuando no hay productos === */
        .no-productos {
            text-align: center;
            color: #7a5c4a;
            font-style: italic;
            padding: 20px;
        }

        /* === Pie de página === */
        footer {
            margin-top: 40px;
            text-align: center;
            color: #fffaf0;
            font-size: 14px;
            padding: 15px;
            background-color: #5c4033;
        }

        /* tooltip sencillo para descripción completa */
        .desc-cell {
            position: relative;
            cursor: help;
        }
        .desc-cell .full {
            display: none;
            position: absolute;
            left: 0;
            top: 100%;
            z-index: 9;
            width: 360px;
            background: #fffaf0;
            border: 1px solid #a0522d;
            padding: 10px;
            border-radius: 6px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.15);
            color: #5c4033;
            font-size: 13px;
            text-align: left;
        }
        .desc-cell:hover .full {
            display: block;
        }
    </style>
</head>
<body>
    <header>
        <h2>Panel del Administrador</h2>
        <a href="{{ route('logout') }}">Cerrar sesión</a>
    </header>

    <main>
        <h3>Lista de Productos</h3>

        <a href="{{ route('productos.create') }}" class="btn-crear"> Crear producto</a>

        @if(count($productos) > 0)
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Tipo</th>
                        <th>Material</th>
                        <th>Precio</th>
                        <th>Stock</th>
                        <th class="desc">Descripción</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($productos as $p)
                    <tr>
                        <td>{{ $p->id_producto }}</td>
                        <td>{{ $p->nombre }}</td>
                        <td>{{ $p->nombre_tipo ?? 'Sin tipo' }}</td>
                        <td>{{ $p->material }}</td>
                        <td>${{ number_format($p->precio, 0, ',', '.') }}</td>
                        <td>{{ $p->stock }}</td>

            
                        <td class="desc desc-cell">
                            {{-- usar Str::limit para truncar (si no usas "use" en Blade) --}}
                            {{ \Illuminate\Support\Str::limit($p->descripcion ?? '-', 80, '...') }}
                            <div class="full">
                                <strong>Descripción completa:</strong>
                                <p style="margin:8px 0 0 0;">{{ $p->descripcion ?? 'Sin descripción' }}</p>
                            </div>
                        </td>

                        <td>
                            <div class="acciones">
                                <a href="{{ route ('productos.show',$p->id_producto)}}" class="btn-ver"> Ver</a>
                                <a href="{{ route('productos.edit', $p->id_producto) }}" class="btn-editar"> Editar</a>
                                <form action="{{ route('productos.destroy', $p->id_producto) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('¿Deseas eliminar este producto?')" class="btn-eliminar"> Eliminar</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        @else
            <p class="no-productos">No hay productos registrados.</p>
        @endif
    </main>

    <footer>
        © {{ date('Y') }} Carpintería | Panel del Administrador 🪵
    </footer>
</body>
</html>
