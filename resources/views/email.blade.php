

<html>
    
    <style>
        a.inc{ 
            text-decoration-color: none;
            text-decoration: none;
            color: white;
            background-color: #3399FF;
            padding: 1%;
            float: right;
        }
        a.inc:hover{
            text-decoration: none; 
            background-color: #6CB5FF;
        }
    </style>
    <body>
    <div class="container">
            <table border="1px solid black">
                    <tr>
                        <th>Fecha</th>
                        <th>Aula</th>
                        <th>Hora</th>
                        <th>Código del equipo</th>
                        <th>Código de la incidencia</th>
                        <td>ID del profesor</td>
                    </tr>
                    <tr>
                        <td>{{ $incidencia['fecha'] }}</td>
                        <td>{{ $incidencia['aula'] }}</td>
                        <td>{{ $incidencia['hora'] }}</td>
                        <td>{{ $incidencia['codigo_equipo'] }}</td>
                        <td>{{ $incidencia['codigo_incidencia'] }}</td>
                        <td>{{ $incidencia['profesorId'] }}</td>
                    </tr>
    </div>
    </body>