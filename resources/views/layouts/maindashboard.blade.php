<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- <link rel="stylesheet" href="output.css"> --}}
    <title>Dashboard</title>
    @vite('resources/css/app.css')
    <!-- <style>
        *{
            outline-style: solid;
            outline-width: thin;
        }
    </style> -->

</head>

<body class="bg-[#EFF1F3]">
    <!-- overall -->
    <div class="flex flex-row">
        <!-- side menu -->
        <!-- note: remove 'fixed' class for no scroll -->
        <div
            class="menu fixed w-1/5 bg-menu max-w-[260px] h-[100vh] flex flex-col items-center text-white font-semibold text-lg">
            <img src="assets/fyp.png" alt="logo" class="max-h-[85px] mt-8">
            <a href="#" class="w-full h-14 mt-8 text-center pt-3.5 bg-[#EFF1F3] text-[#534582]">Dashboard</a>
            <a href="#" class="w-full h-14 text-center pt-3.5">Individu</a>
            <a href="#" class="w-full h-14 text-center pt-3.5">Alumni</a>
            <div class="flex flex-col w-full gap-y-0 items-center mt-72">
                <img src="assets/logout.png" alt="logout" class="max-h-6">
                <a href="#" class="w-full h-14 text-center pt-2">Logout</a>
            </div>
        </div>

        <!-- main -->
        <!-- note: remove 'overflow-auto' class for no scroll -->
        <div class="main ml-[260px] w-full overflow-auto">
            <!-- top -->
            <div class="bg-white mx-auto w-[97%] py-3 flex flex-row rounded-bl-[10px] rounded-br-[10px]">
                <span class="ml-16 my-auto">Welcome to FindYourPath!</span>
                <input type="search" value="Search" class="ml-20 my-auto rounded-3xl h-8 py-1 px-6 text-[#A5A5A5] bg-[#EAECEE] outline-none"><button type="submit" class="rounded-3xl bg-[#534582] my-auto h-8 px-9 outline-none"></button>
                <span class="ml-96 text-4xl mb-1 font-thin text-[#7B6FA9] opacity-20">|</span>
                <a href="#" class="ml-4 rounded-full w-7 h-7 my-auto bg-[#E5E0F4]"><img src="assets/notif.png" class="w-[25px] mx-auto mt-0.5"></a>
                <a href="#" class="ml-4 rounded-full w-7 h-7 my-auto bg-[#E5E0F4]"><img src="assets/msg.png" class="w-[20px] mx-auto mt-1"></a>
                <span class="ml-4 text-4xl mb-1 font-thin text-[#7B6FA9] opacity-20">|</span>
                <a href="#" class="ml-4 rounded-full w-7 h-7 my-auto bg-[#5D4E8E]"><img src="assets/user.png" class="w-[27px] mr-1 mt-1"></a>
            </div>
            <!-- stats -->
            <div class="mt-5 mx-auto w-[97%] gap-x-5 flex flex-row">
                <div class="bg-white w-1/4 h-[120px] rounded-[10px]">
                    <div class="bg-[#F29995] w-3 h-full my-auto rounded-l-[10px] float-left"></div>
                    <img src="assets/countdown.png" class="w-[40px] mt-7 ml-[46px] float-left">
                    <div class="bg-[#EAECEE] w-0.5 h-20 ml-[46px] mt-5 float-left"></div>
                    <div class="float-left ml-9 mt-7"><p class="text-2xl font-bold">
                    H-30<br>
                    SNBT
                    </p>
                    </div>
                </div>
                <div class="bg-white w-1/4 h-[120px] rounded-[10px]">
                    <div class="bg-[#5D4E8E] w-3 h-full my-auto rounded-l-[10px] float-left"></div>
                    <img src="assets/acception.png" class="w-[62px] mt-[30px] ml-[35px] float-left">
                    <div class="bg-[#EAECEE] w-0.5 h-20 ml-[35px] mt-5 float-left"></div>
                    <div class="float-left ml-6 mt-6 font-semibold"><p class="text-2xl font-bold">
                        73%
                        </p>
                        <p class="text-sm">Acceptance<br>
                        Rate</p>
                        </div>
                </div>
                <div class="bg-white w-1/4 h-[120px] rounded-[10px]">
                    <div class="bg-[#FEC000] w-3 h-full my-auto rounded-l-[10px] float-left"></div>
                    <img src="assets/siswa.png" class="w-[66px] mt-[30px] ml-[30px] float-left">
                    <div class="bg-[#EAECEE] w-0.5 h-20 ml-[32px] mt-5 float-left"></div>
                    <div class="float-left ml-9 mt-9 font-semibold"><p class="text-2xl font-bold">
                        214
                        </p>
                        <p class="text-sm">Students</p>
                        </div>
                </div>
                <div class="bg-white w-1/4 h-[120px] rounded-[10px]">
                    <div class="bg-[#3FB560] w-3 h-full my-auto rounded-l-[10px] float-left"></div>
                    <img src="assets/guru.png" class="w-[70px] mt-[28px] ml-[30px] float-left">
                    <div class="bg-[#EAECEE] w-0.5 h-20 ml-[30px] mt-5 float-left"></div>
                    <div class="float-left ml-9 mt-8 font-semibold"><p class="text-2xl font-bold">
                        32
                        </p>
                        <p class="text-sm">Teachers</p>
                        </div>
                </div>
            </div>
            <!-- contents -->
            <!-- note: make the white divs shorter (h) for no scroll -->
            <div class="flex flex-row gap-x-5 m-5">
                <!-- trial split into two -->
                <div class="w-1/2">
                    <div class="bg-white h-[400px] w-full rounded-[10px]">
                        
                    </div>
                    <div class="bg-white h-[292px] w-full mt-5 rounded-[10px]">
                        
                    </div>
                </div>
                <div class="w-1/2">
                    <div class="bg-white h-52 w-full rounded-[10px]">
                        
                    </div>
                    <div class="bg-white h-56 w-full mt-5 rounded-[10px]">
                        
                    </div>
                    <div class="bg-white h-60 w-full mt-5 rounded-[10px]">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>