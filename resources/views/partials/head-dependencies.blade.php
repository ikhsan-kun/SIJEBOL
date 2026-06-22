<!-- Global Dependencies -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Outfit:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">

<!-- Tailwind Play CDN -->
<link rel="stylesheet" href="{{ asset('css/custom-style.css') }}">

<!-- Alpine.js -->
<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

<style>
    [x-cloak] { display: none !important; }
    
    :root {
        --primary: #003178;
        --primary-dark: #002252;
        --primary-light: #3b82f6;
    }

    /* Selection Color */
    ::selection {
        background-color: rgba(0, 49, 120, 0.2);
        color: var(--primary);
    }

    /* Smooth Scroll */
    html {
        scroll-behavior: smooth;
    }
</style>

<script>
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    primary: '#003178',
                    secondary: '#FFC107',
                },
                fontFamily: {
                    sans: ['Inter', 'sans-serif'],
                    outfit: ['Outfit', 'sans-serif'],
                },
                borderRadius: {
                    '2xl': '1.25rem',
                    '3xl': '1.5rem',
                }
            }
        }
    }
</script>

