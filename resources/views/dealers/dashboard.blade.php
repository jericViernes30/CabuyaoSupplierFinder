<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/5bf9be4e76.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="shortcut icon" href="{{asset('images/logo-2.png')}}" type="image/x-icon">
    @vite('resources/css/app.css')
    <title>Dashboard</title>
</head>
<body class="w-full h-screen bg-white-v2">
    <div class="flex h-full">
        @include('components.sidebar')
        <div class="w-[86%] h-full">
            <div class="w-full flex items-center justify-end h-[10%]">
                <div class="w-[15%] text-center">
                    <button class="text-white text-sm py-2 px-5 bg-[#383535] rounded-full">Lim Rice Trading</button>
                </div>
            </div>
            <div class="w-full p-7 h-[90%]">
                <div class="w-full flex items-center justify-between mb-10">
                    <p class="text-xl font-medium">Dealer's Dashboard</p>
                    {{-- <div class="w-1/4 flex items-center gap-2 mb-2">
                        <a href="/RGarage/" class="hover:text-black-v1 duration-75 ease-out">Rice List</a>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512" width="15" height="15" fill="#a8a8a8"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M246.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-128-128c-9.2-9.2-22.9-11.9-34.9-6.9s-19.8 16.6-19.8 29.6l0 256c0 12.9 7.8 24.6 19.8 29.6s25.7 2.2 34.9-6.9l128-128z"/></svg>
                        <p>Login</p>
                    </div> --}}
                </div>
                <div class="w-full mb-4">
                    <div class="flex justify-evenly items-center gap-4">
                        <div class="w-1/4 flex flex-col items-center py-10 justify-center shadow-md rounded-lg bg-[#c6e1e9]">
                            <p class="text-5xl font-semibold">10</p>
                            <p>Grains on sale</p>
                        </div>
                        <div class="w-1/4 flex flex-col items-center py-10 justify-center shadow-md rounded-lg bg-[#c6e1e9]">
                            <p class="text-5xl font-semibold">25</p>
                            <p>Pending Orders</p>
                        </div>
                        <div class="w-1/4 flex flex-col items-center py-10 justify-center shadow-md rounded-lg bg-[#c6e1e9]">
                            <p class="text-5xl font-semibold">646</p>
                            <p>Rice Sacks Sold</p>
                        </div>
                        <div class="w-1/4 flex flex-col items-center py-7 justify-center shadow-md rounded-lg bg-[#c6e1e9]">
                            <div class="w-full flex items-center justify-center gap-2">
                                <p class="text-5xl font-semibold">76503</p>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="28" height="28" fill="#22c55e"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M64 64c0-17.7-14.3-32-32-32S0 46.3 0 64L0 400c0 44.2 35.8 80 80 80l400 0c17.7 0 32-14.3 32-32s-14.3-32-32-32L80 416c-8.8 0-16-7.2-16-16L64 64zm406.6 86.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L320 210.7l-57.4-57.4c-12.5-12.5-32.8-12.5-45.3 0l-112 112c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L240 221.3l57.4 57.4c12.5 12.5 32.8 12.5 45.3 0l128-128z"/></svg>
                            </div>
                            <p class="text-sm text-green-500">123% higher than previous</p>
                            <p>Total Profit</p>
                        </div>
                    </div>
                </div>
                <div class="w-full flex gap-4">
                    <div class="w-1/2 bg-[#f1e4f0] p-2 rounded-lg">
                        <p class="text-center mb-4">Monthly Sales</p>
                        <canvas id="salesChart"></canvas>
                    </div>
                    <div class="w-1/2 bg-[#f1e4f0] p-2 rounded-lg">
                        <p class="text-center mb-4">Sacks Sold per Brand</p>
                        <canvas id="riceSalesChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Generate random sales data
        const generateRandomSales = () => {
            return Array.from({ length: 12 }, () => Math.floor(Math.random() * 10000));
        };

        const ctx = document.getElementById('salesChart').getContext('2d');
        const salesChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                datasets: [{
                    label: 'Sales Total',
                    data: generateRandomSales(),
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 10000
                    }
                }
            }
        });

        const generateRandomSacks = () => {
            return Array.from({ length: 10 }, () => Math.floor(Math.random() * (250 - 100 + 1)) + 100);
        };

        const ctx1 = document.getElementById('riceSalesChart').getContext('2d');
        const riceSalesChart = new Chart(ctx1, {
            type: 'bar',
            data: {
                labels: ['Jasmine', 'Basmati', 'Arborio', 'Carnaroli', 'Sona Masoori', 'Brown Rice', 'Glutinous Rice', 'Red Rice', 'Wild Rice', 'Black Rice'],
                datasets: [{
                    label: 'Total Sacks Sold',
                    data: generateRandomSacks(),
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(199, 199, 199, 0.2)',
                        'rgba(100, 181, 246, 0.2)',
                        'rgba(233, 30, 99, 0.2)',
                        'rgba(121, 85, 72, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(199, 199, 199, 1)',
                        'rgba(100, 181, 246, 1)',
                        'rgba(233, 30, 99, 1)',
                        'rgba(121, 85, 72, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return `${tooltipItem.label}: ${tooltipItem.raw} sacks`;
                            }
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>