<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'Laravel'))</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <!-- Scripts -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        neutral: {
                            850: '#1f1f1f',
                            950: '#0a0a0a',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .glass {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0) rotate(0deg);
            }

            50% {
                transform: translateY(-20px) rotate(5deg);
            }
        }

        @keyframes float-delayed {

            0%,
            100% {
                transform: translateY(0) rotate(0deg);
            }

            50% {
                transform: translateY(25px) rotate(-5deg);
            }
        }

        @keyframes drift {

            0%,
            100% {
                transform: translateX(0);
            }

            50% {
                transform: translateX(15px);
            }
        }

        .animate-float {
            animation: float 10s ease-in-out infinite;
        }

        .animate-float-delayed {
            animation: float-delayed 12s ease-in-out infinite;
        }
    </style>
</head>

<body
    class="bg-neutral-950 text-neutral-200 antialiased h-screen w-full overflow-hidden relative selection:bg-neutral-700 selection:text-white">

    <!-- Animated 3D Background Elements -->
    <div class="fixed top-0 left-0 w-full h-full overflow-hidden -z-10 bg-[#050505]" id="background-container">
        <!-- Base Gradient -->
        <div class="absolute inset-0 bg-gradient-to-br from-neutral-950 via-[#0a0a0a] to-[#151515]"></div>

        <!-- Parallax Layer: Deep (Slow Movement) -->
        <div class="parallax-layer absolute inset-0 pointer-events-none" data-speed="0.04">
            <!-- Top Left Cluster -->
            <img src="{{ asset('images/cube-3d.png') }}"
                class="absolute top-[-5%] left-[5%] w-32 opacity-40 mix-blend-screen animate-float blur-[2px]"
                alt="3D Shape">
            <img src="{{ asset('images/pyramid-3d.png') }}"
                class="absolute top-[20%] left-[2%] w-24 opacity-30 mix-blend-screen animate-float-delayed blur-[1px]"
                alt="3D Shape">

            <!-- Bottom Right Cluster -->
            <img src="{{ asset('images/sphere-3d.png') }}"
                class="absolute bottom-[-10%] right-[-5%] w-64 opacity-30 mix-blend-screen animate-float blur-[3px]"
                alt="3D Shape">
            <img src="{{ asset('images/torus-3d.png') }}"
                class="absolute bottom-[30%] right-[5%] w-32 opacity-20 mix-blend-screen animate-float-delayed"
                alt="3D Shape">
        </div>

        <!-- Parallax Layer: Mid (Medium Movement) -->
        <div class="parallax-layer absolute inset-0 pointer-events-none" data-speed="0.07">
            <!-- Random Scattered Objects -->
            <img src="{{ asset('images/octahedron-3d.png') }}"
                class="absolute top-[15%] right-[25%] w-20 opacity-40 mix-blend-screen animate-float rotate-45"
                alt="3D Shape">
            <img src="{{ asset('images/cube-3d.png') }}"
                class="absolute bottom-[20%] left-[25%] w-28 opacity-35 mix-blend-screen animate-float-delayed brightness-125"
                alt="3D Shape">
            <img src="{{ asset('images/torus-3d.png') }}"
                class="absolute top-[40%] left-[10%] w-40 opacity-25 mix-blend-screen animate-float blur-[1px]"
                alt="3D Shape">
            <img src="{{ asset('images/pyramid-3d.png') }}"
                class="absolute bottom-[40%] right-[15%] w-36 opacity-30 mix-blend-screen animate-float-delayed"
                alt="3D Shape">
            <img src="{{ asset('images/sphere-3d.png') }}"
                class="absolute top-[5%] right-[40%] w-16 opacity-40 mix-blend-screen animate-float blur-[2px]"
                alt="3D Shape">
        </div>

        <!-- Parallax Layer: Front (Fast Movement) -->
        <div class="parallax-layer absolute inset-0 pointer-events-none" data-speed="0.09">
            <!-- Foreground Elements -->
            <img src="{{ asset('images/octahedron-3d.png') }}"
                class="absolute top-[60%] right-[5%] w-32 opacity-50 mix-blend-screen animate-float brightness-150"
                alt="3D Shape">
            <img src="{{ asset('images/cube-3d.png') }}"
                class="absolute top-[10%] left-[80%] w-24 opacity-60 mix-blend-screen animate-float-delayed brightness-125"
                alt="3D Shape">
            <img src="{{ asset('images/sphere-3d.png') }}"
                class="absolute bottom-[5%] left-[40%] w-20 opacity-50 mix-blend-screen animate-float blur-[1px]"
                alt="3D Shape">
            <img src="{{ asset('images/torus-3d.png') }}"
                class="absolute top-[80%] left-[-2%] w-48 opacity-40 mix-blend-screen animate-float-delayed blur-[2px]"
                alt="3D Shape">
            <img src="{{ asset('images/pyramid-3d.png') }}"
                class="absolute top-[-5%] right-[10%] w-40 opacity-40 mix-blend-screen animate-float brightness-125"
                alt="3D Shape">
            <img src="{{ asset('images/octahedron-3d.png') }}"
                class="absolute bottom-[10%] left-[5%] w-16 opacity-60 mix-blend-screen animate-float-delayed"
                alt="3D Shape">
        </div>

        <!-- Noise Overlay for Texture -->
        <div class="absolute inset-0 opacity-[0.03] pointer-events-none"
            style="background-image: url('data:image/svg+xml,%3Csvg viewBox=%220 0 200 200%22 xmlns=%22http://www.w3.org/2000/svg%22%3E%3Cfilter id=%22noise%22%3E%3CfeTurbulence type=%22fractalNoise%22 baseFrequency=%220.65%22 numOctaves=%223%22 stitchTiles=%22stitch%22/%3E%3C/filter%3E%3Crect width=%22100%25%22 height=%22100%25%22 filter=%22url(%23noise)%22 opacity=%220.5%22/%3E%3C/svg%3E');">
        </div>
    </div>

    <div class="min-h-screen flex flex-col items-center justify-center p-6 relative z-10">
        @yield('content')
    </div>


    <!-- SCRIPTS -->
    <!-- jQuery (required) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        document.addEventListener('mousemove', (e) => {
            const layers = document.querySelectorAll('.parallax-layer');
            const x = (window.innerWidth - e.pageX * 2) / 100;
            const y = (window.innerHeight - e.pageY * 2) / 100;

            layers.forEach(layer => {
                const speed = layer.getAttribute('data-speed');
                const xPos = x * speed * 100; // Multiplied for noticeable effect
                const yPos = y * speed * 100;
                
                layer.style.transform = `translateX(${xPos}px) translateY(${yPos}px)`;
                layer.style.transition = 'transform 0.1s ease-out'; // Smooth easing
            });
        });
    </script>
    <!-- Toastr Script -->
    <script>
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "timeOut": "3000"
        };
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            @if(session('success'))
                toastr.success(@json(session('success')));
            @endIf

            @if(session('error'))
                toastr.error(@json(session('error')));
            @endif

            @if($errors->any())
                @foreach($errors->all() as $error)
                    toastr.error(@json($error));
                @endforeach
            @endif

            @if(session('warning'))
                toastr.warning(@json(session('warning')));
            @endif

            @if(session('info'))
                toastr.info(@json(session('info')));
            @endif
        });
    </script>
</body>

</html>