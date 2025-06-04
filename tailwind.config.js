import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: ['class'],
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.{vue,js,ts,jsx,tsx}',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: [
                    'Instrument Sans',
                    ...defaultTheme.fontFamily.sans
                ]
            },
            borderRadius: {
                lg: 'var(--radius)',
                md: 'calc(var(--radius) - 2px)',
                sm: 'calc(var(--radius) - 4px)'
            },
            colors: {
                background: 'hsl(var(--background))',
                foreground: 'hsl(var(--foreground))',
                card: {
                    DEFAULT: 'hsl(var(--card))',
                    foreground: 'hsl(var(--card-foreground))'
                },
                popover: {
                    DEFAULT: 'hsl(var(--popover))',
                    foreground: 'hsl(var(--popover-foreground))'
                },
                primary: {
                    DEFAULT: 'hsl(var(--primary))',
                    foreground: 'hsl(var(--primary-foreground))'
                },
                secondary: {
                    DEFAULT: 'hsl(var(--secondary))',
                    foreground: 'hsl(var(--secondary-foreground))'
                },
                muted: {
                    DEFAULT: 'hsl(var(--muted))',
                    foreground: 'hsl(var(--muted-foreground))'
                },
                accent: {
                    DEFAULT: 'hsl(var(--accent))',
                    foreground: 'hsl(var(--accent-foreground))'
                },
                destructive: {
                    DEFAULT: 'hsl(var(--destructive))',
                    foreground: 'hsl(var(--destructive-foreground))'
                },
                border: 'hsl(var(--border))',
                input: 'hsl(var(--input))',
                ring: 'hsl(var(--ring))',
                chart: {
                    '1': 'hsl(var(--chart-1))',
                    '2': 'hsl(var(--chart-2))',
                    '3': 'hsl(var(--chart-3))',
                    '4': 'hsl(var(--chart-4))',
                    '5': 'hsl(var(--chart-5))'
                },
                sidebar: {
                    DEFAULT: 'hsl(var(--sidebar-background))',
                    foreground: 'hsl(var(--sidebar-foreground))',
                    primary: 'hsl(var(--sidebar-primary))',
                    'primary-foreground': 'hsl(var(--sidebar-primary-foreground))',
                    accent: 'hsl(var(--sidebar-accent))',
                    'accent-foreground': 'hsl(var(--sidebar-accent-foreground))',
                    border: 'hsl(var(--sidebar-border))',
                    ring: 'hsl(var(--sidebar-ring))'
                },
                // 🎨 Colores del tema oscuro personalizado
                'dark-theme': {
                    'primary': '#111827',      // gray-900
                    'secondary': '#1f2937',    // gray-800
                    'accent': '#374151',       // gray-700
                    'surface': '#0f172a',      // slate-900 (alternativa más oscura)
                    'text': '#f9fafb',         // gray-100
                    'text-muted': '#e5e7eb',   // gray-200
                    'text-subtle': '#9ca3af',  // gray-400
                    'border': '#4b5563',       // gray-600
                    'border-subtle': '#374151' // gray-700
                }
            },
            // 🌈 Gradientes personalizados
            backgroundImage: {
                // Gradientes principales del panel
                'dark-gradient': 'linear-gradient(135deg, #111827 0%, #1f2937 50%, #000000 100%)',
                'dark-header': 'linear-gradient(90deg, #1f2937 0%, #111827 100%)',
                'dark-card': 'linear-gradient(135deg, #1f2937 0%, #111827 100%)',

                // Gradientes de acento coloridos
                'accent-gradient': 'linear-gradient(90deg, #60a5fa 0%, #a78bfa 50%, #f472b6 100%)',
                'accent-subtle': 'linear-gradient(90deg, #3b82f6 0%, #8b5cf6 50%, #ec4899 100%)',

                // Gradientes de estado
                'success-gradient': 'linear-gradient(90deg, #10b981 0%, #059669 100%)',
                'warning-gradient': 'linear-gradient(90deg, #f59e0b 0%, #d97706 100%)',
                'error-gradient': 'linear-gradient(90deg, #ef4444 0%, #dc2626 100%)',

                // Gradientes sutiles para overlays
                'overlay-gradient': 'linear-gradient(180deg, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0.4) 100%)',
                'fade-gradient': 'linear-gradient(180deg, rgba(31,41,55,0.5) 0%, transparent 100%)'
            },
            // 🎭 Animaciones personalizadas
            animation: {
                'slide-in-right': 'slideInRight 0.3s ease-out',
                'slide-out-right': 'slideOutRight 0.2s ease-in',
                'fade-in': 'fadeIn 0.3s ease-out',
                'fade-out': 'fadeOut 0.2s ease-in',
                'glow': 'glow 2s ease-in-out infinite alternate'
            },
            // 🎬 Keyframes para animaciones
            keyframes: {
                slideInRight: {
                    '0%': { transform: 'translateX(100%)', opacity: '0' },
                    '100%': { transform: 'translateX(0)', opacity: '1' }
                },
                slideOutRight: {
                    '0%': { transform: 'translateX(0)', opacity: '1' },
                    '100%': { transform: 'translateX(100%)', opacity: '0' }
                },
                fadeIn: {
                    '0%': { opacity: '0' },
                    '100%': { opacity: '1' }
                },
                fadeOut: {
                    '0%': { opacity: '1' },
                    '100%': { opacity: '0' }
                },
                glow: {
                    '0%': { boxShadow: '0 0 5px rgba(96, 165, 250, 0.5)' },
                    '100%': { boxShadow: '0 0 20px rgba(96, 165, 250, 0.8)' }
                }
            },
            // 📏 Espaciado personalizado
            spacing: {
                '18': '4.5rem',   // 72px
                '88': '22rem',    // 352px
                '104': '26rem',   // 416px
                '120': '30rem'    // 480px
            },
            // 🎯 Z-index personalizado
            zIndex: {
                '60': '60',
                '70': '70',
                '80': '80',
                '90': '90',
                '100': '100'
            },
            // 🌫️ Blur personalizado
            backdropBlur: {
                'xs': '2px',
                '4xl': '72px'
            }
        }
    },
    plugins: [
        require('tailwindcss-animate'),
        // Plugin personalizado para utilidades del tema oscuro
        function ({ addUtilities }) {
            const newUtilities = {
                // Utilidades de fondo
                '.bg-dark-primary': {
                    background: 'linear-gradient(135deg, #111827 0%, #1f2937 50%, #000000 100%)'
                },
                '.bg-dark-header': {
                    background: 'linear-gradient(90deg, #1f2937 0%, #111827 100%)'
                },
                '.bg-dark-card': {
                    background: 'linear-gradient(135deg, #1f2937 0%, #111827 100%)'
                },

                // Utilidades de texto
                '.text-dark-primary': {
                    color: '#f9fafb'
                },
                '.text-dark-secondary': {
                    color: '#e5e7eb'
                },
                '.text-dark-muted': {
                    color: '#9ca3af'
                },

                // Utilidades de borde
                '.border-dark': {
                    borderColor: 'rgba(75, 85, 99, 0.5)'
                },
                '.border-dark-subtle': {
                    borderColor: 'rgba(55, 65, 81, 0.8)'
                },

                // Línea de acento
                '.accent-line': {
                    background: 'linear-gradient(90deg, #60a5fa 0%, #a78bfa 50%, #f472b6 100%)'
                },

                // Scrollbar personalizada
                '.scrollbar-dark': {
                    scrollbarWidth: 'thin',
                    scrollbarColor: 'rgba(75, 85, 99, 0.5) transparent'
                },
                '.scrollbar-dark::-webkit-scrollbar': {
                    width: '6px'
                },
                '.scrollbar-dark::-webkit-scrollbar-track': {
                    background: 'transparent'
                },
                '.scrollbar-dark::-webkit-scrollbar-thumb': {
                    backgroundColor: 'rgba(75, 85, 99, 0.5)',
                    borderRadius: '3px'
                },
                '.scrollbar-dark::-webkit-scrollbar-thumb:hover': {
                    backgroundColor: 'rgba(75, 85, 99, 0.8)'
                }
            }

            addUtilities(newUtilities)
        }
    ],
};
