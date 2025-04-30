<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Modules</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row mt-5">
            <div class="col-sm-4 mb-3 mb-sm-0">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Backup db</h5>
                        <p class="card-text">Take backup of the entire database.</p>
                        <form action="{{ route('backup.store') }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-primary">backup</button>
                        </form>
                    </div>
                </div>
            </div>
            
        </div>
        <div class="row mt-5">
            <div class="col-sm-8 mb-3 mb-sm-0">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Sr.no</th>
                            <th scope="col">Name</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i=1; @endphp
                        @foreach($files as $data)
                        <tr>
                            <th scope="row">{{ $i }}</th>
                            <td>{{ basename($data) }}</td>
                            <td><a href="{{ route('download.backup', ['filename' => basename($data)]) }}" type="btn btn-primary">Download</a></td>
                        </tr>
                        @php $i++; @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous">
        </script>
</body>

</html>