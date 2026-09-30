<!DOCTYPE html>
<html lang="id">


<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">


<title>
@yield('title','LSP UMLA')
</title>
<link rel="stylesheet" href="{{ asset('css/style.css') }}">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">


</head>



<body>



@include('components.navbar')



<main>

@yield('content')

</main>



@include('components.footer')




<script src="{{ asset('js/main.js') }}"></script>
<script src="{{ asset('js/skema.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>
</body>


</html>