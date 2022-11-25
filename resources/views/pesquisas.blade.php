<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>        
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <link href="{{ asset('css/filtrosGeral.css') }}" rel="stylesheet">
        <link href="{{ asset('css/estiloSelect2MultiploGeral.css') }}" rel="stylesheet">
        
        
        <script src="{{ asset('js/pesquisas.js') }}"></script>
        <title>Voch Tech Avaliação</title>
    </head>
    <body>
        <div class="container">
            <div class="card mt-5">
                <h4 class="card-header">Filtros</h4>
                <div class="card-body">
                    <form class="w-100">
                        {!! $filtros['gruposEconomicos'] !!}
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>