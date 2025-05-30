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
                        <h5 class="card-title">Modules</h5>
                        <p class="card-text">Adding modules.</p>
                        <a href="{{ route('addmodule') }}" class="btn btn-primary">Add</a>
                    </div>
                </div>
            </div>
            @foreach($modules as $module)
            <div class="col">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{ basename($module) }}</h5>
                                <p class="card-text">Simple {{ basename($module) }} module.</p>
                                <div class="d-flex gap-2">
                                    <form action="{{ route('modules.toggle', basename($module)) }}" method="post">
                                        @csrf
                                        @if (Module::isEnabled(basename($module)))
                                        <button type="submit" class="btn btn-secondary">Disable</button>
                                        @else
                                        <button type="submit" class="btn btn-success">Enable</button>
                                        @endif
                                    </form>
                                    <a href="{{ route('downloadModule',basename($module)) }}"
                                        class="btn btn-info">Export</a>
                                    <form action="{{ route('removeModule', basename($module)) }}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous">
        </script>
</body>

</html>