/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./index.html", "./*.php", "./common/*.php", "./admin/*.php"],
  theme: {
    colors: {
      dark: "#d4f1f4",
      lessDark: "#161d2f",
      lightDark: "#1c2338",
      light: "#f5f5f9",
      lightGray: "#343541",
      lightRed: "#ff4d4d",
      cleanLight: "#D4F1F4",
      ivory: "#EEEDE7",
      lightGreen: "#00ff00",
    },
    extend: {},
  },
  plugins: [],
};
