module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        colors: {
            brand: '#bf201d',
            brandHover: '#991B1B',
            light: '#f4f2f1',
            lightAccent: '#d67621',
            lightAccentHover: '#b5631b',
            dark: '#34283e',
            darkAccent: '#b58b7f',
            darkAccentHover: '#d6a496',
            primary: '#bf201d',
            info: '#33283e',
            success: '#6f8441',
            warning: '#ec7409',
            danger: '#f44336',
            disabled: '#d2d2d2',
        },
        extend: {
            fontFamily: {
                'display': ['Oswald', 'sans-serif'],
                'sans': ['Lato', 'sans-serif'],
            },
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
