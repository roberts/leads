module.exports = {
    purge: [
        './resources/**/*.blade.php',
    ],
    darkMode: false,
    theme: {
        extend: {
            fontSize: {
                'tiny': '.65rem',
            },
            fontFamily: {
                'serif': ['Merriweather', 'ui-serif', 'Georgia', 'serif'],
            },
            colors: {
                'primary': '#ff0083',
                'danger': '#F87171',
            },
        },
    },
    variants: {
        extend: {},
    },
    plugins: [],
}
