@extends('layouts.navstart')
@section('title','Landing page')
@section('container')
<section class="h-full py-20 bg-gray-100" style="background-image: url('/images/landing/landing-page.jpg')">
  <div class="container mx-auto ">
    <div class="h-96 w-96 float-right bg-pink-400 bg-opacity-25 rounded-full">
      <img src="{{ asset('images/landing/1.png') }}" alt="gambar1" class="w-full h-full object-cover" />
    </div>
      <div class="w-7/12 mx-8">
        <h1 class="text-8xl text-white mb-4">
          Disover Your Path,
          Excel Your Future
        </h1> 
        <p class="pt-3 text-2xl text-white mb-5">
          Find Your Path (FYP) adalah sistem informasi
          yang membantu pengelola bimbingan belajar
          dalam memberi rekomendasi jurusan dan
          universitas yang tepat untuk siswa.
        </p>
        <button class="bg-slate-300 50 shadow-md rounded-md font-bold text-lg text-purple-700 w-72 h-10 mt-2"><a href="../Login/src/index.html">Mulai Sekarang</a> </button>
      </div>
    </div>
</section>
@endsection

</body>
</html>