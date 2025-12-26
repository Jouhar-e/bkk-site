@props(['profile'])

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- Title --}}
    <title>BKK - {{ $profile->name_bkk ?? 'Portal BKK' }}</title>

    {{-- Icon --}}
    <link rel="icon" type="image/png" href="{{ asset('storage/' . ltrim($profile->logo, '/')) }}">


    {{-- Styles --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">
    <style>
        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        @media (max-width: 640px) {
            .container {
                padding-left: 1rem;
                padding-right: 1rem;
            }
        }

        /* Desktop Link Styles */
        /* Additional styles for better dropdown experience */
        .dropdown-menu {
            min-width: 12rem;
        }

        /* Ensure dropdown stays on top */
        .group:hover .dropdown-menu {
            pointer-events: auto;
        }

        /* Smooth transitions */
        .dropdown-menu,
        .mobile-dropdown-content {
            transition: all 0.3s ease;
        }

        /* Active state for mobile links */
        .mobile-dropdown-content a.active {
            @apply text-white font-medium;
        }

        /* Hover effects for better UX */
        .mobile-dropdown-content a:hover {
            @apply pl-5 transition-all duration-200;
        }

        /* Additional styles for better responsiveness */
        @media (max-width: 768px) {
            .container {
                padding-left: 1rem;
                padding-right: 1rem;
            }

            .md\\:col-span-2 {
                grid-column: span 1;
            }
        }

        /* Smooth transitions */
        a,
        button {
            transition: all 0.3s ease;
        }

        /* Break long email/website text */
        .break-all {
            word-break: break-all;
        }

        /* Hover effects */
        .hover\\:scale-110:hover {
            transform: scale(1.1);
        }
    </style>
</head>
