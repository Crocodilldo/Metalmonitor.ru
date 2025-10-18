<template>
  <div
    class="w-full sm:w-64 bg-white rounded-2xl shadow-md hover:shadow-lg transition-shadow duration-300 overflow-hidden cursor-pointer border border-gray-100"
  >
    <!-- Контент -->

    <div class="p-4 flex flex-col justify-between h-full">
      <a :href="product.url" rel="noopener noreferrer">
        <div>
          <p class="text-sm text-gray-500 mb-1">{{ product.category_name }}</p>
          <h3 class="font-semibold text-gray-800 text-lg mb-2 break-words whitespace-normal">
            {{ product.name }}
          </h3>
          <p v-if="product.parameter" class="text-sm text-gray-600 mb-3">
            <span class="font-medium">Размер:</span> {{ product.parameter }}
          </p>
        </div>

        <div class="flex items-center justify-between mt-auto">
          <p class="text-sm text-gray-500">{{ product.shop_name }}</p>
          <p class="text-xl font-bold text-blue-700">{{ product.price }} ₽</p>
        </div>
      </a>
    </div>
  </div>
</template>

<script setup>
defineProps({
  product: {
    type: Object,
    required: true,
    default: () => ({
      name: 'Название товара',
      category_name: 'Категория',
      parameter: '',
      shop_name: 'Магазин Metalmonitor.ru',
      price: '-',
      image: '/images/no-image.png',
    }),
  },
})
</script>
