<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>API</title>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div class="card-body">
        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th scope="col" style="width: 30px;">Qtd.</th>
                    <th scope="col">Personagem</th>
                    <th scope="col" style="width: 30px;">Idade</th>
                    <th scope="col">Filme</th>
                    <th scope="col" style="width: 30px;">Lançamento</th>
                    <th scope="col" style="width: 50px;">Pontuação</th>

                </tr>
            </thead>
            <tbody>
                @if(!empty($data))
                    @php $count = 0; @endphp
                    @foreach ($data as $film)
                        @php $count++; @endphp
                        <tr>
                            <th scope="row">{{$count}}</th>
                            <td>{{$film['name']}}</td>
                            <td>{{$film['age']}}</td>
                            <td>{{$film['title']}}</td>
                            <td>{{$film['release_date']}}</td>
                            <td>{{$film['rt_score']}}</td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>
