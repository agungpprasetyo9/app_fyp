@extends('layouts.admindash')

@section('title', "Admin Dashboard")

@section('style')
<style>
  table {
      border-collapse: collapse;
  }
  th, td {
      padding: 10px;
      text-align: center;
      border: 1px solid #ddd;
  }
  th {
      background-color: #f2f2f2;
  }
  td:hover {
      background-color: #e2e2e2;
  }
  .today {
      background-color: #ffcccc;
  }
</style>
@endsection

@section('container')

<section>
    <!-- stats -->
    <div class="mt-5 mx-auto items-center sm:justify-center w-[97%] gap-x-5 gap-y-5 lg:gap-y-0 flex flex-col flex-nowrap sm:flex-row sm:flex-wrap lg:flex-row lg:flex-nowrap">
        <div class="bg-white w-[97%] sm:w-[285px] md:w-[270px] lg:w-1/4 h-[120px] rounded-[10px] flex flex-row md:block">
          <div class="bg-[#F29995] w-3 h-full my-auto rounded-l-[10px] sm:float-left"></div>
          <img src="{{ asset('images/dashassets/countdown.png') }}" class="flex ml-[75px] sm:inline w-[40px] my-auto sm:mt-7 sm:ml-[46px] sm:float-left" />
          <div class="bg-[#EAECEE] w-0.5 h-20 flex ml-[80px] sm:ml-[46px] mt-5 sm:float-left"></div>
          <div class="sm:float-left ml-[80px] sm:ml-8 lg:ml-5 mt-7">
            <p class="text-2xl lg:text-lg font-bold">
              H-30<br />
              SNBT
            </p>
          </div>
        </div>
        <div class="bg-white w-[97%] sm:w-[285px] md:w-[270px] lg:w-1/4 h-[120px] rounded-[10px] flex flex-row md:block">
          <div class="bg-[#5D4E8E] w-3 h-full my-auto rounded-l-[10px] sm:float-left"></div>
          <img src="{{ asset('images/dashassets/acception.png') }}" class="flex ml-[70px] sm:inline w-[58px] my-auto sm:mt-[30px] sm:ml-[35px] sm:float-left" />
          <div class="bg-[#EAECEE] w-0.5 h-20 flex ml-[66px] sm:ml-[35px] mt-5 sm:float-left"></div>
          <div class="sm:float-left ml-[70px] sm:ml-8 lg:ml-5 mt-6 font-semibold">
            <p class="text-2xl lg:text-lg font-bold">{{ $percentage }}%</p>
            <p class="text-sm">
              Acceptance<br />
              Rate
            </p>
          </div>
        </div>
        <div class="bg-white w-[97%] sm:w-[285px] md:w-[270px] lg:w-1/4 h-[120px] rounded-[10px] flex flex-row md:block">
          <div class="bg-[#FEC000] w-3 h-full my-auto rounded-l-[10px] sm:float-left"></div>
          <img src="{{ asset('images/dashassets/siswa.png') }}" class="flex sm:inline w-[66px] my-auto sm:mt-[30px] ml-[70px] sm:ml-[30px] sm:float-left" />
          <div class="bg-[#EAECEE] w-0.5 h-20 flex ml-[64px] sm:ml-[35px] mt-5 sm:float-left"></div>
          <div class="sm:float-left ml-[70px] sm:ml-9 lg:ml-6 mt-9 font-semibold">
            <p class="text-2xl lg:text-lg font-bold">{{ $studentCount }}</p>
            <p class="text-sm">Students</p>
          </div>
        </div>
        <div class="bg-white w-[97%] sm:w-[285px] md:w-[270px] lg:w-1/4 h-[120px] rounded-[10px] flex flex-row md:block">
          <div class="bg-[#3FB560] w-3 h-full my-auto rounded-l-[10px] sm:float-left"></div>
          <img src="{{ asset('images/dashassets/guru.png') }}" class="flex sm:inline my-auto w-[70px] sm:mt-[28px] ml-[70px] sm:ml-[30px] sm:float-left" />
          <div class="bg-[#EAECEE] w-0.5 h-20 flex ml-[64px] sm:ml-[30px] mt-5 sm:float-left"></div>
          <div class="sm:float-left ml-[70px] sm:ml-9 lg:ml-6 mt-8 font-semibold">
            <p class="text-2xl lg:text-lg font-bold">32</p>
            <p class="text-sm">Alumni</p>
          </div>
        </div>
    </div>

    {{-- chart --}}
    <div class="flex flex-col lg:flex-row gap-x-5 m-2 mt-5 sm:m-5">
        <!-- trial split into two -->
        <div class="w-full lg:w-1/2 order-2 mt-5 lg:mt-0 lg:order-1 justify-center">
          <div class="bg-white h-fit w-full rounded-[10px] text-center">
            <h1 class="font-bold text-xl p-4 pt-3">Calender</h1>
            <div id="calendar" class="p-3"></div>
          </div>
          <div class="bg-white h-[292px] w-full mt-5 rounded-[10px]">
            <h1 class="font-bold text-xl p-4 pt-3">Rekomendasi Kelas Tambahan</h1>
            <div class="flex flex-row justify-center p-4 pt-4 gap-x-5">
              <div class="w-[130px] h-fit bg-[#7B6FA9] bg-opacity-[30%] rounded-[10px]">
                <p class="font-bold text-sm text-center text-[#534582] p-2">
                  {{ $subjectNames[0] }}
                </p>
              </div>
              <div class="w-[130px] h-fit bg-[#FBE0DF] rounded-[10px] p-2">
                <p class="font-bold text-sm text-center text-[#F29995]">
                  {{ $subjectNames[1] }}
                </p>
              </div>
              <div class="w-[130px] h-fit bg-[#3FB560] bg-opacity-[30%] rounded-[10px]">
                <p class="font-bold text-sm text-center text-[#288F43] p-2">
                  {{ $subjectNames[2] }}
                </p>
              </div>
            </div>
          </div>
        </div>
        <div class="w-full lg:w-1/2 order-1 lg:order-2">
          <div class="bg-white h-fit lg:h-fit w-full rounded-[10px]">
            <h1 class="font-bold text-xl p-4 pt-3">Perkembangan Nilai per Try Out</h1>
            {!! $tryoutAVG->container() !!}
          </div>
          
          <div class="bg-white h-64 lg:h-56 w-full mt-5 rounded-[10px]">
            <h1 class="font-bold text-xl p-4 pt-3">Statistik Nilai persubject</h1>
            {!! $subjectValue->container() !!}
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
    </div>
</section>
@endsection

@section('scripts')
{{-- calender --}}
<script>
  function buildCalendar() {
      var currentDate = new Date();
      var currentYear = currentDate.getFullYear();
      var currentMonth = currentDate.getMonth();

      var calendarContainer = document.getElementById('calendar');

      // Create the table element
      var table = document.createElement('table');

      // Create the header row
      var headerRow = document.createElement('tr');
      var headerCell = document.createElement('th');
      headerCell.setAttribute('colspan', '7');
      headerCell.textContent = getMonthName(currentMonth) + ' ' + currentYear;
      headerRow.appendChild(headerCell);
      table.appendChild(headerRow);

      // Create the weekday header row
      var weekdays = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
      var weekdaysRow = document.createElement('tr');
      for (var i = 0; i < weekdays.length; i++) {
          var weekdaysCell = document.createElement('th');
          weekdaysCell.textContent = weekdays[i];
          weekdaysRow.appendChild(weekdaysCell);
      }
      table.appendChild(weekdaysRow);

      // Get the first day of the month
      var firstDay = new Date(currentYear, currentMonth, 1);
      var startingDay = firstDay.getDay();

      // Get the number of days in the month
      var lastDay = new Date(currentYear, currentMonth + 1, 0);
      var totalDays = lastDay.getDate();

      // Create the calendar rows
      var calendarDays = [];
      var dayCounter = 1;
      for (var row = 0; row < 6; row++) {
          var calendarRow = document.createElement('tr');
          for (var col = 0; col < 7; col++) {
              if (row === 0 && col < startingDay) {
                  var calendarCell = document.createElement('td');
                  calendarRow.appendChild(calendarCell);
              } else if (dayCounter > totalDays) {
                  break;
              } else {
                  var calendarCell = document.createElement('td');
                  calendarCell.textContent = dayCounter;
                  if (currentDate.getDate() === dayCounter && currentDate.getMonth() === currentMonth && currentDate.getFullYear() === currentYear) {
                      calendarCell.classList.add('today');
                  }
                  calendarRow.appendChild(calendarCell);
                  dayCounter++;
              }
          }
          calendarDays.push(calendarRow);
      }

      // Add the calendar rows to the table
      for (var i = 0; i < calendarDays.length; i++) {
          table.appendChild(calendarDays[i]);
      }

      // Clear the calendar container and append the table
      calendarContainer.innerHTML = '';
      calendarContainer.appendChild(table);
  }

  function getMonthName(monthIndex) {
      var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
      return months[monthIndex];
  }

  // Build the initial calendar
  buildCalendar();
</script>
{{-- end calender --}}
<script src="{{ $tryoutAVG->cdn() }}"></script>
{{ $tryoutAVG->script() }} 
<script src="{{ $subjectValue->cdn() }}"></script>
{{ $subjectValue->script() }}  
@endsection
