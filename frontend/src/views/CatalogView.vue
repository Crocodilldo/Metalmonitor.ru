<template>
  <div class="p-6 w-full xl:w-5/6 m-auto">
    <h1 class="text-lg  font-bold mb-6">Каталог товаров</h1>

    <!-- Состояние загрузки -->
    <p v-if="productStore.isLoading" class="text-gray-500">Загрузка товаров...</p>
    <p v-if="productStore.error" class="text-red-500">{{ productStore.error }}</p>

    <!-- Сортировка -->
    <div class="flex items-center gap-2 mb-4">
      <label for="sort" class="font-semibold">Сортировка:</label>
      <select id="sort" v-model="sortKey" class="border px-2 py-1 rounded">
        <option value="">По магазинам</option>
        <option value="price_asc">Цена: по возрастанию</option>
        <option value="price_desc">Цена: по убыванию</option>
      </select>
    </div>

    <!-- Фильтры по параметрам -->
    <details>
      <summary class="cursor-pointer items-center text-lg font-bold text-gray-600">
        Фильтры
      </summary>
      <div v-if="productStore.products.length" class="mb-4">
        <h3 class="font-semibold mb-2">Фильтровать по параметрам:</h3>
        <div class="flex flex-wrap gap-3">
          <label v-for="param in availableParameters" :key="param" class="flex items-center gap-1">
            <input type="checkbox" :value="param" v-model="selectedParameters" />
            {{ param }}
          </label>
        </div>
      </div>
      <!-- Кнопка сброса -->
      <button
        @click="clearFilters"
        class="px-3 py-1 md:py-3 bg-gray-100 hover:bg-gray-200 text-sm rounded-md text-gray-700 cursor-pointer"
      >
        Сбросить все фильтры
      </button>
    </details>

    <!-- Сетка товаров -->
    <div
      v-if="!productStore.isLoading && !productStore.error && filteredProducts.length"
      class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6"
    >
      <ProductCard v-for="product in filteredProducts" :key="product.id" :product="product" />
    </div>

    <!-- Пустой список -->
    <p
      v-if="!productStore.isLoading && !productStore.error && filteredProducts.length === 0"
      class="text-gray-500 mt-4"
    >
      Товары не найдены.
    </p>
  </div>
</template>

<script setup>
import { onMounted, watch, ref, computed } from 'vue'
import { useRoute } from 'vue-router'
import ProductCard from '@/components/ProductCard.vue'
import { useProductStore } from '@/stores/productStore'

const route = useRoute()
const productStore = useProductStore()

// Выбранные параметры фильтрации
const selectedParameters = ref([])

// Сортировка
const sortKey = ref('')

// Динамическое формирование доступных параметров из API
const availableParameters = computed(() => {
  const set = new Set()
  productStore.products.forEach((p) => {
    if (p.parameter) set.add(p.parameter)
  })
  return Array.from(set).sort()
})

// Функция загрузки товаров с учетом query-параметров
const loadProductsFromRoute = () => {
  const search = route.query.search || ''
  const category_id = route.query.category_id || null
  selectedParameters.value = [] //сброс фильтров
  productStore.fetchProducts({ search, category_id })
}

// Загружаем товары при монтировании и при изменении query
onMounted(() => loadProductsFromRoute())
watch(
  () => route.query,
  () => loadProductsFromRoute()
)

// Фильтруем и сортируем товары
const filteredProducts = computed(() => {
  let items = [...productStore.products]

  // Фильтрация по параметрам
  if (selectedParameters.value.length > 0) {
    items = items.filter((p) => selectedParameters.value.includes(p.parameter))
  }

  // Сортировка
  switch (sortKey.value) {
    case 'price_asc':
      items.sort((a, b) => a.price - b.price)
      break
    case 'price_desc':
      items.sort((a, b) => b.price - a.price)
      break
  }

  return items
})

// Сброс фильтров
const clearFilters = () => {
  selectedParameters.value = []
}
</script>
