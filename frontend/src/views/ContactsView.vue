<template>
  <section class="flex flex-col items-center text-center py-16 px-4 bg-gray-50 min-h-[60vh]">
    <h2 class="text-3xl font-semibold mb-2">Свяжитесь с нами</h2>
    <p class="text-gray-600 mb-10">
      Мы всегда открыты для общения и сотрудничества
    </p>

    <div class="flex flex-wrap justify-center gap-6 max-w-4xl">
      <div
        class="bg-white rounded-2xl shadow-md p-6 w-64 transition-transform hover:-translate-y-1 hover:shadow-lg"
      >
        <h3 class="text-xl font-medium mb-2">📧 Email</h3>
        <p class="text-emerald-600 hover:underline">
          info@example.com
        </p>
      </div>

      <div
        class="bg-white rounded-2xl shadow-md p-6 w-64 transition-transform hover:-translate-y-1 hover:shadow-lg"
      >
        <h3 class="text-xl font-medium mb-2">📞 Телефон</h3>
        <p class="text-emerald-600 hover:underline">
          +@ (123) 456-78-90
        </p>
      </div>

      <div
        class="bg-white rounded-2xl shadow-md p-6 w-64 transition-transform hover:-translate-y-1 hover:shadow-lg"
      >
        <h3 class="text-xl font-medium mb-2">📍 Адрес</h3>
        <p class="text-gray-700">
          г. Барнаул.
        </p>
      </div>
    </div>
  </section>
</template>

<script setup>
</script>
