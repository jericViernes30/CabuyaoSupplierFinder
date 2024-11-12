/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      dropShadow: {
        'custom': '0 0 10px rgba(158, 228, 215, 1)', // Custom red shadow
      },
      colors: {
        'white-v2': '#f6f7fa',
        'main' : '#95e1d4',
        'black-v2' : '#343a40',
        'secondary' : '#6c757d'
      }
    },
  },
  plugins: [],
}