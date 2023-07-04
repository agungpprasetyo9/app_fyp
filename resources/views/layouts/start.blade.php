<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    @vite('resources/css/app.css')
    <title>@yield('title')</title>
    
    <!-- <link rel="stylesheet" href="style.css""> -->

    <!-- tailwindcss -->
    <script src="https://cdn.tailwindcss.com"></script>
  </head>
  <body style="background-image: url('{{ asset('images/dashboardassets/landing-page.jpg')}}') ">
    <div class=" p-20">
      <img src="{{ asset('images/dashboardassets/fyp.png')}}" alt="" class="max-h-[85px] mb-9">
      <div class="h-96 w-96  float-right bg-pink-400 bg-opacity-25 rounded-full"><img src="1.p{{ asset('images/dashboardassets/1.png')}}ng" alt="gambar1" class="w-full justify-center" /></div>
      <h1 class="text-8xl text-white">
        Disover Your Path,
        Excel Your Future
      </h1>
      <p class="pt-3 text-2xl text-white">
        Find Your Path (FYP) adalah sistem informasi
        yang membantu pengelola bimbingan belajar
        dalam memberi rekomendasi jurusan dan
        universitas yang tepat untuk siswa.
      </p>
      <button class="bg-slate-300 50 shadow-md rounded-md font-bold text-lg text-purple-700 w-72 h-10 mt-2"><a href="../Login/src/index.html">Mulai Sekarang</a> </button>
    </div>
  </body>
</html>
