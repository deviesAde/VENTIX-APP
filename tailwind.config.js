// tailwind.config.js
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                primary: {
                    100: "rgb(var(--color-primary) / 0.1)",
                    200: "rgb(var(--color-primary) / 0.2)",
                    300: "rgb(var(--color-primary) / 0.3)",
                    400: "rgb(var(--color-primary) / 0.4)",
                    500: "rgb(var(--color-primary) / 1)",
                    600: "rgb(calc(var(--color-primary) - 20) / 1)",
                    700: "rgb(calc(var(--color-primary) - 40) / 1)",
                },
                secondary: {
                    100: "rgb(var(--color-secondary) / 0.1)",
                    500: "rgb(var(--color-secondary) / 1)",
                    600: "rgb(calc(var(--color-secondary) - 20) / 1)",
                },
                accent: {
                    100: "rgb(var(--color-accent) / 0.1)",
                    500: "rgb(var(--color-accent) / 1)",
                    600: "rgb(calc(var(--color-accent) - 20) / 1)",
                },
                dark: "rgb(var(--color-dark) / 1)",
                light: "rgb(var(--color-light) / 1)",
            },
        },
    },
    plugins: [],
};
