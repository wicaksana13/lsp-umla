<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>
@yield('title','Peserta LSP UMLA')
</title>


<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">


<link rel="stylesheet" href="{{ asset('css/participant.css') }}">


</head>


<body class="participant-body">


<div class="participant-shell">



<!-- SIDEBAR -->

<aside class="participant-sidebar" id="participantSidebar">



<a href="{{ route('peserta.dashboard') }}"
class="participant-brand">


<span class="participant-brand-mark">

LSP

</span>



<div>

<b>
Peserta
</b>

<small>
LSP UMLA
</small>

</div>


</a>





<nav class="participant-nav">


<a href="{{route('peserta.dashboard')}}"
class="{{request()->routeIs('peserta.dashboard')?'active':''}}">

▦

<span>
Dashboard
</span>

</a>





<a href="{{route('peserta.schedule')}}"
class="{{request()->routeIs('peserta.schedule')?'active':''}}">

📅

<span>
Daftar Asesmen
</span>

</a>





<a href="{{route('peserta.assessment')}}"
class="{{request()->routeIs('peserta.assessment')?'active':''}}">

✓

<span>
Asesmen Saya
</span>

</a>





<a href="{{route('peserta.unit')}}"
class="{{request()->routeIs('peserta.unit')?'active':''}}">

◫

<span>
Unit Kompetensi
</span>

</a>





<a href="{{route('peserta.certificate')}}"
class="{{request()->routeIs('peserta.certificate')?'active':''}}">

◇

<span>
Sertifikat
</span>

</a>





<a href="{{route('peserta.profile')}}"
class="{{request()->routeIs('peserta.profile')?'active':''}}">

♙

<span>
Profil Saya
</span>

</a>





<form action="{{route('logout')}}" method="POST">

@csrf


<button>

🚪

<span>
Keluar
</span>

</button>


</form>




</nav>


</aside>








<!-- MAIN -->

<div class="participant-main">



<header class="participant-topbar">


<button class="participant-menu-toggle"
onclick="document.getElementById('participantSidebar').classList.toggle('show')">

☰

</button>



<div class="participant-topbar-title">

<span>
PESERTA
</span>


<b>
@yield('page_title','Dashboard')
</b>


</div>







<div class="participant-user">


<div class="participant-avatar">


{{ strtoupper(substr(auth()->user()->name,0,1)) }}


</div>



<div>

<b>

{{auth()->user()->name}}

</b>


<small>

Peserta Sertifikasi

</small>


</div>



</div>



</header>








<main class="participant-content">


@if(session('success'))

<div class="participant-alert success">

{{session('success')}}

</div>

@endif



@if(session('error'))

<div class="participant-alert danger">

{{session('error')}}

</div>

@endif



@yield('content')



</main>




</div>


</div>





<script>

document.addEventListener(
"click",
function(e){


let sidebar =
document.getElementById(
'participantSidebar'
);


let button =
document.querySelector(
'.participant-menu-toggle'
);



if(
window.innerWidth <=820 &&
!sidebar.contains(e.target)&&
!button.contains(e.target)
){

sidebar.classList.remove('show');

}


});


</script>



</body>

</html>