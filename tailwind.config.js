module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
    ],
    theme: {
        extend: {
            colors: {
                primary: {
                    DEFAULT: '#75B42E',
                    dark: '#009600'
                },
                secondary: {
                    DEFAULT: '#C70046',
                    light: '#FF004D',
                    lightest: '#E0024E'
                },
                blue: {
                    DEFAULT: '#0039BC',
                    light: '#005DCE',
                    lightest: '#0080E1'
                },
                'orange': {
                    DEFAULT: '#F78200',
                    light: '#FF9B2B',
                    lightest: '#FFAF1C'
                }
            },
            fontFamily: {
                "space-grotesk": ['SpaceGrotesk']
            },
        },
    },
    plugins: [

    ],
}
