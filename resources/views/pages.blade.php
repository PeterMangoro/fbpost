<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<main class="container ">
    <h1 class="pt-5">Pages Table for {{ $user }}</h1>

    <table class="table">
        <thead>
        <tr>

            <th scope="col">Name</th>
            <th scope="col">Category</th>
            <th scope="col">Handle</th>
        </tr>
        </thead>
        <tbody>
        @foreach($pages as $page)
            <tr>

                <td>{{ $page->name }}</td>
                <td>{{ $page->category }}</td>
                <td>

                    <a class="btn btn-primary" href="{{ route('facebook.create',$page->page_id) }}" role="button">Create Post</a>


                </td>
            </tr>
        @endforeach

        </tbody>
    </table>

</main>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
</body>
</html>
<script>

</script>
