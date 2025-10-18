<template>
  <section
    class="relative w-full xl:w-5/6 m-auto h-[60vh] sm:h-[70vh] flex flex-col justify-center items-center text-center bg-gray-100 overflow-hidden z-0"
  >
    <!-- Фоновое изображение -->
    <img
      src="@/assets/img/hero-bg.png"
      alt="Металлопрокат на складе"
      class="absolute inset-0 w-full h-full object-cover opacity-80"
    />



    <!-- Контент -->
    <div class="relative z-10 text-white px-4 sm:px-8">
      <h1 class="text-3xl sm:text-5xl font-bold mb-4 drop-shadow-lg">
        Металлопрокат по лучшим ценам
      </h1>
      <p class="text-lg sm:text-xl mb-6 max-w-2xl mx-auto drop-shadow-md">
        Найдите нужный металл, сравните цены и выберите лучшее предложение на Metalmonitor.ru
      </p>

      <router-link
        to="/catalog"
        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg text-lg font-semibold transition"
      >
        Перейти в каталог
      </router-link>
    </div>
  </section>
</template>

<script setup>
</script>
