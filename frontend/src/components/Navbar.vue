<template>
  <div
    class="sticky top-0 flex justify-between w-full xl:w-5/6 m-auto bg-white shadow-xl mt-4 border-b-1 border-b-gray-300 px-4 lg:px-8 py-3 lg:py-4 z-10"
  >
    <div class="flex items-center">
      <router-link to="/"
        ><h1 class="text-lg sm:text-xl lg:text-2xl font-bold">Metalmonitor.ru</h1></router-link
      >
    </div>
    <ul class="hidden md:flex items-center gap-3 lg:gap-10 font-bold text-gray-600">
      <router-link to="/"
        ><li
          class="flex items-center gap-3 hover:text-blue-900 cursor-pointer hover:translate-y-0.5 transition"
        >
          Главная
        </li></router-link
      >
      <li
        class="relative group flex items-center gap-3 hover:text-blue-900 cursor-pointer hover:translate-y-0.5 transition"
      >
        <!-- Дропдаун меню каталога-->
        <router-link class="inline-flex items-center gap-3" to="/catalog">
          Каталог
          <svg
            class="w-4 h-4 transition-transform group-hover:rotate-180"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M19 9l-7 7-7-7"
            />
          </svg>
        </router-link>
        <ul
          class="absolute left-0 top-full w-auto bg-white border-1 border-gray-300 invisible group-hover:visible"
        >
          <router-link
            @click="closeAllMenus"
            v-for="item in catalogItems"
            :key="item.category_id"
            :to="{ name: 'catalog', query: { category_id: item.category_id } }"
          >
            <li
              class="flex items-center px-4 py-1 text-gray-700 hover:bg-blue-50 hover:text-blue-900 transition"
            >
              {{ item.name }}
            </li>
          </router-link>
        </ul>
      </li>

      <!-- Дропдаун меню инструментов-->
      <li
        class="relative group flex items-center gap-3 hover:text-blue-900 cursor-pointer hover:translate-y-0.5 transition"
      >
        Инструменты
        <svg
          class="w-4 h-4 transition-transform group-hover:rotate-180"
          fill="none"
          stroke="currentColor"
          viewBox="0 0 24 24"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M19 9l-7 7-7-7"
          />
        </svg>

        <ul
          class="absolute left-0 top-full w-auto bg-white border-1 border-gray-300 invisible group-hover:visible"
        >
          <router-link v-for="item in toolItems" :key="item.name" :to="item.link">
            <li
              class="flex items-center px-4 py-1 text-gray-700 hover:bg-blue-50 hover:text-blue-900 transition"
            >
              {{ item.name }}
            </li>
          </router-link>
        </ul>
      </li>
      <router-link to="/articles">
        <li
          class="flex items-center gap-3 hover:text-blue-900 cursor-pointer hover:translate-y-0.5 transition"
        >
          Статьи
        </li>
      </router-link>
      <router-link to="/contacts">
        <li
          class="flex items-center gap-3 hover:text-blue-900 cursor-pointer hover:translate-y-0.5 transition"
        >
          Контакты
        </li>
      </router-link>
    </ul>
    <button
      v-if="search === 'uzumymw'"
      @click="$emit('update:modelValue', true)"
      class="border-1 rounded-lg px-1 bg-blue-600 hover:bg-blue-700 text-white cursor-pointer"
    >
      Вход
    </button>
    <div class="flex items-center max-w-2xl">
      <input
        v-model="search"
        @keyup.enter="searchProducts"
        class="border-1 rounded-sm px-2 w-32 lg:w-40"
        placeholder="Поиск"
      />
    </div>

    <!-- Бургер-кнопка для мобильных -->
    <button @click="isMobileMenuOpen = !isMobileMenuOpen" class="md:hidden p-2">
      <div class="w-6 h-0.5 bg-black mb-1.5"></div>
      <div class="w-6 h-0.5 bg-black mb-1.5"></div>
      <div class="w-6 h-0.5 bg-black"></div>
    </button>

    <!-- Мобильное меню -->
    <div
      v-show="isMobileMenuOpen"
      class="md:hidden py-4 border-t absolute top-full left-0 right-0 bg-white"
    >
      <ul>
        <li class="flex items-center gap-3 hover:text-blue-900 cursor-pointer">Главная</li>
        <li
          @click="openCatalog"
          class="relative group flex items-center gap-3 hover:text-blue-900 cursor-pointer"
        >
          <!-- Дропдаун меню каталога-->
          Каталог
          <svg
            class="w-4 h-4 transition-transform cursor-pointer"
            :class="{ 'rotate-180': isCatalogOpen }"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M19 9l-7 7-7-7"
            />
          </svg>

          <ul
            v-show="isCatalogOpen"
            class="absolute left-0 top-full w-auto bg-white border-1 border-gray-300 cursor-pointer z-20"
          >
            <router-link
              @click="closeAllMenus"
              v-for="item in catalogItems"
              :key="item.category_id"
              :to="{ name: 'catalog', query: { category_id: item.category_id } }"
            >
              <li class="flex items-center px-4 py-1 text-gray-700">
                {{ item.name }}
              </li>
            </router-link>
          </ul>
        </li>

        <!-- Дропдаун меню инструментов-->
        <li
          @click="openTool"
          class="relative group flex items-center gap-3 hover:text-blue-900 cursor-pointer"
        >
          Инструменты<svg
            class="w-4 h-4 transition-transform cursor-pointer"
            :class="{ 'rotate-180': isToolOpen }"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M19 9l-7 7-7-7"
            />
          </svg>

          <ul
            v-show="isToolOpen"
            class="absolute left-0 top-full w-auto bg-white border-1 border-gray-300 cursor-pointer z-10"
          >
            <router-link v-for="item in toolItems" :key="item.name" :to="item.link">
              <li class="flex items-center px-4 py-1 text-gray-700" cursor-pointer>
                {{ item.name }}
              </li>
            </router-link>
          </ul>
        </li>
        <li class="flex items-center gap-3 hover:text-blue-900 cursor-pointer">Статьи</li>
        <li class="flex items-center gap-3 hover:text-blue-900 cursor-pointer">Контакты</li>
      </ul>
    </div>
  </div>
</template>

<script setup>
const catalogItems = [
  { name: 'Труба круглая', category_id: 1 },
  { name: 'Труба профильная', category_id: 2 },
  { name: 'Круг', category_id: 3 },
  { name: 'Арматура', category_id: 4 },
  { name: 'Полоса', category_id: 5 },
  { name: 'Уголок', category_id: 6 },
  { name: 'Лист', category_id: 7 },
  { name: 'Шестигранник', category_id: 8 },
  { name: 'Швеллер', category_id: 9 },
  { name: 'Двутавр', category_id: 10 },
  { name: 'Квадрат', category_id: 11 },
]

const toolItems = [
  { name: 'ГОСТы', link: '/tools/GOSTs' },
  { name: 'Калькулятор металла', link: '/tools/metal_calc' },
]

import { ref } from 'vue'
import { useProductStore } from '@/stores/productStore'
import { useRouter } from 'vue-router'

const isMobileMenuOpen = ref(false)
const isCatalogOpen = ref(false)
const isToolOpen = ref(false)

const openCatalog = () => {
  isCatalogOpen.value = !isCatalogOpen.value
  isToolOpen.value = false
}

const openTool = () => {
  isToolOpen.value = !isToolOpen.value
  isCatalogOpen.value = false
}

const router = useRouter()
const search = ref('')

const searchProducts = () => {
  if (!search.value.trim()) return

  router.push({
    name: 'catalog',
    query: {
      search: search.value.trim(),
    },
  })
}

const closeAllMenus = () => {
  isCatalogOpen.value = false
  isToolOpen.value = false
  isMobileMenuOpen.value = false
}

defineProps({
  modelValue: Boolean,
})
defineEmits(['update:modelValue'])
</script>
<style>
</style>