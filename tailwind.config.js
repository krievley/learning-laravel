module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                'display': ['Oswald', 'sans-serif'],
                'sans': ['Lato', 'sans-serif'],
            },
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
