/** @type {import('tailwindcss').Config} */
export default {
  darkMode: 'class',
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      // safelist: ['animate-[fade-in_1s_ease-in-out]', 'animate-[fade-out-down_1s_ease-in-out]']
    },
  },
  plugins: [
  //   require('flowbite/plugin')({
  //     charts: true,
  // }),
  ],
}