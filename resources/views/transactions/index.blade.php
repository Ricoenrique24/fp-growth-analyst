<x-midone.app-layout>
    <x-slot name="breadcrumb">
        <nav aria-label="breadcrumb" class="-intro-x mr-auto h-full">
            <ol class="breadcrumb breadcrumb-light">
                <li class="breadcrumb-item active">Transaction</li>
            </ol>
        </nav>
    </x-slot>
    <div class="intro-y mt-5">
        <h1 class="text-2xl font-medium mt-5 mb-5" style="font-size: 2em; margin-top: 5px" class="mb-5">Transaksi</h1>
    </div>
    <div class="flex flex-wrap -mx-3 mt-5">
        <div class="w-full sm:w-1/2 xl:w-1/2 px-3 mb-6">
            <div class="report-box zoom-in">
                <div class="box p-5">
                    <div class="text-3xl font-medium leading-8 mt-6">{{ $count }}</div>
                    <div class="text-base text-slate-500 mt-1">Total Transaksi</div>
                </div>
            </div>
        </div>
        <div class="w-full sm:w-1/2 xl:w-1/2 px-3 mb-6">
            <div class="report-box zoom-in">
                <div class="box p-5">
                    <div class="text-3xl font-medium leading-8 mt-6">{{ $count }}</div>
                    <div class="text-base text-slate-500 mt-1">Total Produk</div>
                </div>
            </div>
        </div>
    </div>
    <div class="intro-y box mt-5">
        <div class="p-5">
            <h1 class="text-2xl mt-5 mb-5" style="font-size: 2em; margin-top: 5px" class="mb-5">Data Terlaris dalam 3
                Bulan</h1>
            <div class="overflow-x-auto">
                <canvas id="myChart"></canvas>
            </div>
            <div class="overflow-x-auto mt-5">
                <table class="table-sm table-bordered table-hover table">
                    <thead class="table-dark">
                        <tr>
                            <th class="whitespace-nowrap">No</th>
                            <th class="whitespace-nowrap">Tanggal</th>
                            <th class="whitespace-nowrap">No Transaksi</th>
                            <th class="whitespace-nowrap">Pelanggan</th>
                            <th class="whitespace-nowrap">Produk</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($three_bulan as $three)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $three->tanggal }}</td>
                                <td>{{ $three->no_transaksi }}</td>
                                <td>{{ $three->pelanggan }}</td>
                                <td>{{ $three->produk }}</td>
                            </tr>
                        @empty
                            @include('shared._no_data', ['col' => 5])
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="p-5">
            <h1 class="text-2xl mt-5 mb-5">Data Transaksi dalam 1 Tahun</h1>
            <div class="overflow-x-auto">
                <canvas id="myChart2"></canvas>
            </div>
            <div class="overflow-x-auto mt-5">
                <table class="table-sm table-bordered table-hover table">
                    <thead class="table-dark">
                        <tr>
                            <th class="whitespace-nowrap">No</th>
                            <th class="whitespace-nowrap">Tanggal</th>
                            <th class="whitespace-nowrap">No Transaksi</th>
                            <th class="whitespace-nowrap">Pelanggan</th>
                            <th class="whitespace-nowrap">Produk</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($transactions as $order)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $order->tanggal }}</td>
                                <td>{{ $order->no_transaksi }}</td>
                                <td>{{ $order->pelanggan }}</td>
                                <td>{{ $order->produk }}</td>
                            </tr>
                        @empty
                            @include('shared._no_data', ['col' => 5])
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<!-- Sertakan Library Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Data untuk chart 3 Bulan
    const labels3Bulan = ['Ayam Geprek', 'Minuman Segar', 'French Fries', 'Burger', 'Nasi Goreng', 'Pizza', 'Spaghetti',
        'Ice Cream', 'Coffee', 'Juice'
    ];
    const data3Bulan = [65, 59, 80, 81, 56, 55, 40, 70, 65, 60]; // Data dummy untuk 3 bulan
    const backgroundColors3Bulan = generateRandomColors(data3Bulan.length); // Panggil fungsi untuk warna acak

    const config3Bulan = {
        type: 'bar',
        data: {
            labels: labels3Bulan,
            datasets: [{
                label: 'Jumlah Produk',
                data: data3Bulan,
                backgroundColor: backgroundColors3Bulan,
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        },
        options: {
            indexAxis: 'y',
            elements: {
                bar: {
                    borderWidth: 2,
                }
            },
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: 'Top 10 Produk Selama 3 Bulan'
                },
                legend: {
                    display: false, // Menghilangkan legend
                },
            },
        }
    };

    // Data untuk chart 1 Tahun
    const labels1Tahun = ['Ayam Geprek', 'Minuman Segar', 'French Fries', 'Burger', 'Nasi Goreng', 'Pizza', 'Spaghetti',
        'Ice Cream', 'Coffee', 'Juice'
    ];
    const data1Tahun = [45, 55, 70, 65, 50, 40, 35, 60, 55, 50]; // Data dummy untuk 1 tahun
    const backgroundColors1Tahun = generateRandomColors(data1Tahun.length); // Panggil fungsi untuk warna acak

    const config1Tahun = {
        type: 'bar',
        data: {
            labels: labels1Tahun,
            datasets: [{
                label: 'Jumlah Produk',
                data: data1Tahun,
                backgroundColor: backgroundColors1Tahun,
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            indexAxis: 'y',
            elements: {
                bar: {
                    borderWidth: 2,
                }
            },
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: 'Top 10 Produk Selama 1 Tahun'
                },
                legend: {
                    display: false, // Menghilangkan legend
                },
            },
        }
    };

    // Fungsi untuk menghasilkan warna acak
    function generateRandomColors(count) {
        const colors = [];
        for (let i = 0; i < count; i++) {
            const r = Math.floor(Math.random() * 256);
            const g = Math.floor(Math.random() * 256);
            const b = Math.floor(Math.random() * 256);
            const color = `rgba(${r}, ${g}, ${b}, 0.5)`;
            colors.push(color);
        }
        return colors;
    }

    // Inisialisasi chart setelah DOM selesai dimuat
    window.addEventListener('DOMContentLoaded', (event) => {
        const ctx3Bulan = document.getElementById('myChart').getContext('2d');
        new Chart(ctx3Bulan, config3Bulan);
    });

    window.addEventListener('DOMContentLoaded', (event) => {
        const ctx1Tahun = document.getElementById('myChart2').getContext('2d');
        new Chart(ctx1Tahun, config1Tahun);
    });
</script>



</x-midone.app-layout>
