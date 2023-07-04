<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite('resources/css/app.css')
    <title>Dashboard</title>

    <!-- <style>
        *{
            outline-style: solid;
            outline-width: thin;
        }
    </style> -->
  </head>

  <body class="bg-[#EFF1F3]">
    <!-- overall -->
    <div class="flex flex-row m-2 mt-0 sm:m-0">
      <!-- side menu -->
      <!-- note: remove 'fixed' class for no scroll -->
      <div class="hidden md:flex menu fixed top-0 left-0 w-1/5 md:w-2/5 max-w-[260px] h-[100vh] flex-col items-center text-white font-semibold text-lg"style="background-image: url('{{ asset('images/dashassets/menu.png') }}');">
        <img src="{{ asset('images/dashassets/fyp.png') }}" alt="logo" class="max-h-[85px] mt-8" />
        <a href="#" class="w-full h-14 mt-8 text-center pt-3.5 bg-[#EFF1F3] text-[#534582]">Dashboard</a>
        <a href="#" class="w-full h-14 text-center pt-3.5">Individu</a>
        <a href="#" class="w-full h-14 text-center pt-3.5">Alumni</a>
        <div class="flex flex-col w-full gap-y-0 items-center mt-72">
          <img src="{{ asset('images/dashassets/logout.png') }}" alt="logout" class="max-h-6" />
          <a href="#" class="w-full h-14 text-center pt-2">Logout</a>
        </div>
      </div>

      <!-- main -->
      <!-- note: remove 'overflow-auto' class for no scroll -->
      <div class="main md:ml-[260px] w-full overflow-auto">
        <!-- top -->
        <div class="bg-white mx-auto w-[97%] py-3 flex flex-row rounded-bl-[10px] rounded-br-[10px]">
          <span class="ml-4 text-xs lg:text-base lg:ml-16 my-auto">Welcome to FindYourPath!</span>
          <input type="search" value="Search" class="ml-10 md:ml-5 lg:ml-20 text-xs lg:text-base my-auto rounded-3xl h-7 lg:h-8 py-1 px-4 lg:px-6 text-[#A5A5A5] bg-[#EAECEE] outline-none" />
          <button type="submit" class="rounded-3xl bg-[#534582] my-auto h-7 md:h-8 px-3 md:px-6 outline-none">
            <img src="{{ asset('images/dashassets/search.png') }}" class="w-4" />
          </button>
          <span class="hidden lg:inline lg:ml-auto lg:mr-2 text-4xl mb-1 font-thin text-[#7B6FA9] opacity-20">|</span>
          <a href="#" class="hidden md:inline ml-auto mr-2 lg:ml-2 lg:mr-2 rounded-full w-7 h-7 my-auto bg-[#E5E0F4]"><img src="{{ asset('images/dashassets/notif.png') }}" class="w-[25px] mx-auto mt-0.5" /></a>
          <a href="#" class="hidden md:inline md:ml-2 ml-4 mr-2 lg:ml-2 lg:mr-2 rounded-full w-7 h-7 my-auto bg-[#E5E0F4]"><img src="{{ asset('images/dashassets/msg.png') }}" class="w-[20px] mx-auto mt-1" /></a>
          <span class="hidden lg:inline md:ml-2 ml-4 mr-2 lg:ml-2 lg:mr-2 text-4xl mb-1 font-thin text-[#7B6FA9] opacity-20">|</span>
          <a href="#" class="hidden md:inline md:ml-2 ml-4 mr-2 lg:ml-2 lg:mr-4 rounded-full w-7 h-7 my-auto bg-[#5D4E8E]"><img src="{{ asset('images/dashassets/user.png') }}" class="w-[27px] mr-1 mt-1" /></a>

          <!-- dropdown button -->
          <!-- <div class="flex ml-24"> -->
          <button
            id="dropdownDividerButton"
            data-dropdown-toggle="dropdownDivider"
            class="ml-auto mr-2 text-white bg-transparent hover:font-bold focus:outline-none font-medium rounded-lg text-sm text-center inline-flex items-center md:hidden"
            type="button"
          >
            <div class="w-7 h-7 rounded-full bg-[#5D4E8E] flex right-0"><img src="{{ asset('images/dashassets/menudots.png') }}" class="mx-auto w-7 h-7 p-1.5 my-auto" alt="" /></div>
          </button>
          <!-- </div> -->

          <!-- dropdown menu -->
          <div id="dropdownDivider" class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow">
            <ul class="py-1 text-sm" aria-labelledby="dropdownDividerButton">
              <li>
                <a href="#" class="block py-2 px-4 hover:bg-[#5D4E8E] hover:text-white">Dashboard</a>
              </li>
              <li>
                <a href="#" class="block py-2 px-4 hover:bg-[#5D4E8E] hover:text-white">Individu</a>
              </li>
              <li>
                <a href="#" class="block py-2 px-4 hover:bg-[#5D4E8E] hover:text-white">Alumni</a>
              </li>
            </ul>
            <div class="py-1">
              <a href="#" class="block py-2 px-4 text-sm hover:bg-[#5D4E8E] hover:text-white">Logout</a>
            </div>
          </div>
        </div>

        <!-- dari sini masuk -->
        <!-- stats -->
        @yield('container')
        <!-- contents -->
        <!-- note: make the white divs shorter (h) for no scroll -->
        {{-- <div class="flex flex-col lg:flex-row gap-x-5 m-2 mt-5 sm:m-5">
          <!-- trial split into two -->
          <div class="w-full lg:w-1/2 order-2 mt-5 lg:mt-0 lg:order-1">
            <div class="bg-white h-[400px] w-full rounded-[10px]"></div>
            <div class="bg-white h-[292px] w-full mt-5 rounded-[10px]">
              <h1 class="font-bold text-xl p-4 pt-3">Rekomendasi Kelas Tambahan</h1>
              <div class="flex flex-row justify-center p-4 pt-4 gap-x-5">
                <div class="w-[130px] h-[170px] bg-[#7B6FA9] bg-opacity-[30%] rounded-[10px]">
                  <img src="{{ asset('images/dashassets/mtk.png') }}" class="mt-3 mx-auto" />
                  <p class="font-bold text-sm text-center text-[#534582]">
                    Penalaran<br />
                    Matematika
                  </p>
                </div>
                <div class="w-[130px] h-[170px] bg-[#FBE0DF] rounded-[10px]">
                  <img src="{{ asset('images/dashassets/pu.png') }}" class="mt-3 mx-auto" />
                  <p class="font-bold text-sm text-center text-[#F29995]">
                    Pengetahuan<br />
                    Umum
                  </p>
                </div>
                <div class="w-[130px] h-[170px] bg-[#3FB560] bg-opacity-[30%] rounded-[10px]">
                  <img src="{{ asset('images/dashassets/pk.png') }}" class="mt-3 mx-auto" />
                  <p class="font-bold text-sm text-center text-[#288F43]">
                    Pengetahuan<br />
                    Kuantitatif
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div class="w-full lg:w-1/2 order-1 lg:order-2">
            <div class="bg-white h-64 lg:h-52 w-full rounded-[10px]">
              <h1 class="font-bold text-xl p-4 pt-3">Perkembangan Nilai per Try Out</h1>
            </div>
            <div class="bg-white h-64 lg:h-56 w-full mt-5 rounded-[10px]">
              <h1 class="font-bold text-xl p-4 pt-3">Statistik Nilai per Subjek</h1>
            </div>
            <div class="bg-white h-64 lg:h-60 w-full mt-5 rounded-[10px]">
              <h1 class="font-bold text-xl p-4 pt-3">Notifikasi Aktivitas</h1>
              <p class="text-sm p-4">
                <span class="font-bold">Tryout UTBK</span><br />
                <span class="font-semibold">3 Januari 2023</span><br />
                <br />
                Kami berencana untuk mengadakan Tryout UTBK pada tanggal 18 Januari 2023. Kepada para guru dan pembimbing kelas mohon dipersiapkan.
              </p>
            </div>
          </div>
        </div> --}}
 
        <!-- akhir -->
      </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
    <script src="{{ $tryoutAVG->cdn() }}"></script>
        {{ $tryoutAVG->script() }} 
    <script src="{{ $subjectValue->cdn() }}"></script>
        {{ $subjectValue->script() }}  
  </body>
</html>
