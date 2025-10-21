import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/views/**/*.blade.php",
        "./resources/js/**/*.js",
        "./resources/js/**/*.vue",
        // "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
        },
        // safelist: [
        //   "bg-blue-500",
        //   "bg-blue-700",
        //   "bg-green-500",
        //   "bg-indigo-500",
        //   "bg-indigo-700",
        //   "bg-red-500",
        //   "hover:bg-blue-700",
        //   "hover:bg-green-700",
        //   "hover:bg-red-700",
        //   "text-white",
        //   "text-red-500",
        // ],
    },

    plugins: [forms],
};
