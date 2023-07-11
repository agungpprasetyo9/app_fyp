@extends('layouts.studentdash') @section('container')
<!-- stats -->
<div class="bg-transparent flex flex-row m-7 mb-0">
    <div class="rounded-full w-[60px] h-[60px] bg-[#E5E0F4]"></div>
    <div class="ml-4">
        <h1 class="font-semibold text-2xl">{{ $name }}</h1>
        <p class="font-[350]">{{ $email }}</p>
    </div>
</div>
<!-- contents -->
<!-- note: make the white divs shorter (h) for no scroll -->
<div class="flex flex-col lg:flex-row gap-x-5 m-2 mt-5 sm:m-5">
    <!-- trial split into two -->
    <div class="w-full order-2 mt-5 lg:mt-0 lg:order-1">
        <div class="bg-white h-fit w-full rounded-[10px] pb-4">
            <h1 class="font-bold text-xl p-4 pt-3">
                Perkembangan Nilai PerTryout
            </h1>
            {!! $tryout->container() !!}
        </div>
    </div>
    <div class="w-full order-2 mt-5 lg:mt-0 lg:order-1">
        <div class="bg-white h-[300px] w-full rounded-[10px]">
            <h1 class="font-bold text-xl p-4 pt-3">
                Statistik Nilai Persubjek
            </h1>
            <canvas id="barChart"></canvas>
        </div>
    </div>
</div>
<div class="flex flex-col lg:flex-row gap-x-5 m-2 mt-4 sm:m-5">
    <div class="bg-white h-fit w-1/3 mt-5 rounded-[10px] pb-3">
        <h1 class="font-bold text-xl p-4 pt-3">Kehadiran</h1>
        <canvas id="attendanceChart"></canvas>
    </div>
    <div class="bg-white w-full mt-5 rounded-[10px] h-fit">
        <div class="flex flex-row justify-center p-4 pt-1 gap-x-2">
            <h1 class="font-bold text-xl p-4 pt-3">
                Rekomendasi Universitas dan jurusan
            </h1>
        </div>
        <div class="flex flex-row justify-center gap-x-1">
            <div class="px-8">
                <form
                    method="POST"
                    action="{{ route('search') }}"
                    class="justify-end"
                >
                    @csrf
                    <div class="flex items-center mb-2">
                        <label for="pilihan" class="mr-2"
                            >Pilih Salah Satu:</label
                        >
                        <div class="relative inline-block">
                            <select
                                name="pilihan"
                                id="pilihan"
                                class="border border-gray-300 rounded-md p-2"
                                onchange="toggleInput()"
                            >
                                <option value="">Pilih</option>
                                <option value="university">University</option>
                                <option value="major">Major</option>
                            </select>
                            <div id="universityInput" class="hidden">
                                <select
                                    name="universitas"
                                    id="universitas"
                                    class="border border-gray-300 rounded-md p-2"
                                >
                                    <option value="">Semua Universitas</option>
                                    @foreach ($alluniversities as $university)
                                    <option value="{{ $university->id }}">
                                        {{ $university->university_name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div id="majorInput" class="hidden">
                                <select
                                    name="jurusan"
                                    id="jurusan"
                                    class="border border-gray-300 rounded-md p-2"
                                >
                                    <option value="">Semua Jurusan</option>
                                    @foreach ($allmajors as $major)
                                    <option value="{{ $major->id }}">
                                        {{ $major->major_name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    

                    <button
                        type="submit"
                        class="bg-blue-500 text-white py-2 px-4 rounded-md ml-1"
                    >
                        Cari
                    </button>
                    </div>
                </form>
            </div>
        </div>
        @isset($data)
            <canvas id="bubbleChart"></canvas>
        @endisset
            
        
        
        {{-- @dd($data) --}}
    </div>
</div>
@endsection 

@section('script') 
{{-- barchart subject --}}
<script>
    var ctx = document.getElementById('barChart').getContext('2d');
    var data = @json($subjects);
    // var colors = generateColors(data.length);
    var colors = [
        'rgb(83, 69, 130)',
        'rgb(242, 153, 149)',
        'rgb(204, 202, 221)',
        'rgb(96, 210, 126)',
        'rgb(240, 215, 215)',
        'rgb(254, 192, 0)',
    ];


    var labels = data.map(subject => subject.subject_name);
    var values = data.map(subject => subject.nilai);

    var chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Bar Chart',
                data: values,
                backgroundColor: colors,
                borderColor: 'rgba(255, 255, 255, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
    function generateColors(count) {
        var colors = [];
        for (var i = 0; i < count; i++) {
            var r = Math.floor(Math.random() * 256);
            var g = Math.floor(Math.random() * 256);
            var b = Math.floor(Math.random() * 256);
            colors.push('rgba(' + r + ', ' + g + ', ' + b + ', 0.6)');
        }
        return colors;
    }
</script>
{{-- kehadiran --}}
<script>
    var ctx = document.getElementById('attendanceChart').getContext('2d');
    var presentCount = 80;
    var absentCount = 20;

    var chart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Hadir', 'Tidak Hadir'],
            datasets: [{
                data: [presentCount, absentCount],
                backgroundColor: [
                    'rgba(75, 192, 192, 0.6)',
                    'rgba(192, 75, 75, 0.6)'
                ],
                borderColor: [
                    'rgba(75, 192, 192, 1)',
                    'rgba(192, 75, 75, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true
        }
    });
</script>
{{-- bubble chart --}}
<script>
    @isset($data)
        var data = @json($data);

        var ctx = document.getElementById('bubbleChart').getContext('2d');
        var bubbleChart = new Chart(ctx, {
            type: 'bubble',
            data: {
                datasets: [{
                    label: 'Rekomendasi',
                    data: data.map(d => ({
                        x: d.score,
                        y: d.mt*5,
                        r: d.ut *10,
                        name: d.name,
                    })),
                    backgroundColor: 'rgba(75, 192, 192, 0.6)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                }]
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Skor',
                            font: {
                                size: 14,
                                weight: 'bold'
                            }
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Jurusan',
                            font: {
                                size: 14,
                                weight: 'bold'
                            }
                        }
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function (context) {
                                var label = context.dataset.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                label += context.dataset.data[context.dataIndex].name || '';
                                return label;
                            }
                        }
                    }
                }
            }
        });
    @endisset
</script>

{{-- tampilkan linechart --}}
<script src="{{ $tryout->cdn() }}"></script>
{{ $tryout->script() }}

{{-- try buuble --}}



<script>
    const toggleSwitch = document.getElementById("toggleSwitch");

    // const textInput = document.querySelector('input[name="nama_atribut"]');
    const textInput = document.getElementById("input");

    toggleSwitch.addEventListener("change", function () {
        if (toggleSwitch.checked) {
            textInput.name = "major";
            textInput.placeholder = "Search University";
        } else {
            textInput.name = "university";
            textInput.placeholder = "Search Major";
        }
    });
</script>

{{-- ini toggle masukan satu saja input --}}


<script>
    function toggleInput() {
        var pilihanInput = document.getElementById("pilihan");
        var universityInput = document.getElementById("universityInput");
        var majorInput = document.getElementById("majorInput");

        if (pilihanInput.value === "university") {
            universityInput.classList.remove("hidden");
            majorInput.classList.add("hidden");
        } else if (pilihanInput.value === "major") {
            universityInput.classList.add("hidden");
            majorInput.classList.remove("hidden");
        } else {
            universityInput.classList.add("hidden");
            majorInput.classList.add("hidden");
        }
    }
</script>
@endsection
