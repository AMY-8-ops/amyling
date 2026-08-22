/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {},
  },
  plugins: [
    require('daisyui'),
  ],
  daisyui: {
    themes: [
      "valentine",
      "light",
      "dark",
      "cupcake",
      "pastel",
      "retro",
      "cyberpunk",
      "emerald",
      "synthwave",
      "garden",
      "lofi",
      "fantasy",
      "dracula"
    ],
  },
}


