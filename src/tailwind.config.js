module.exports = {
  content: ["./html/**/*.html", "./src/**/*.{js,ts,jsx,tsx}"],
  theme: {
    extend: {
      fontFamily: {
        letraBakso: ['var(--font-BaksoSapi)'],
        letraMon: ['var(--font-Monserrat)'],
        letraSport: ['var(--font-Sportation)'],
      },
      colors: {
        Blanco: 'var(--color-1B)',
        Amarillo: 'var(--color-2A)',
        RosaFuerte: 'var(--color-3RF)',
        RosaClaro: 'var(--color-4RB)',
        AzulClaro: 'var(--color-5AC)',
        GrisMedio: 'var(--color-6GM)',
      },
    },
  },
  plugins: [],
}
