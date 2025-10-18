<template>
  <aside class="w-64 min-h-screen bg-white border-r border-gray-200 shadow-md flex flex-col">
    <!-- Логотип -->
    <div class="px-6 py-4 border-b border-gray-300">
      <h1 class="text-2xl font-bold text-gray-700">Admin Panel</h1>
    </div>

    <!-- Навигация -->
    <nav class="mt-6 flex-1">
      <ul class="flex flex-col">
        <li>
          <router-link
            to="/admin/shops"
            class="flex items-center gap-3 px-6 py-3 text-gray-600 hover:text-blue-600 hover:bg-gray-50 transition"
          >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M3 12h18M3 6h18M3 18h18"
              />
            </svg>
            Магазины
          </router-link>
        </li>

        <li>
          <router-link
            to="/admin/categories"
            class="flex items-center gap-3 px-6 py-3 text-gray-600 hover:text-blue-600 hover:bg-gray-50 transition"
          >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M3 12h18M3 6h18M3 18h18"
              />
            </svg>
            Категории
          </router-link>
        </li>

        <li>
          <router-link
            to="/admin/selectors"
            class="flex items-center gap-3 px-6 py-3 text-gray-600 hover:text-blue-600 hover:bg-gray-50 transition"
          >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M3 12h18M3 6h18M3 18h18"
              />
            </svg>
            Query-селекторы
          </router-link>
        </li>

        <li>
          <router-link
            to="/admin/UpdateLinks"
            class="flex items-center gap-3 px-6 py-3 text-gray-600 hover:text-blue-600 hover:bg-gray-50 transition"
          >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M3 12h18M3 6h18M3 18h18"
              />
            </svg>
            UpdateLinks
          </router-link>
        </li>

        <li>
          <button
            @click="logout"
            class="flex items-center gap-3 px-6 py-3 mt-4 text-gray-600 hover:text-red-600 hover:bg-gray-50 transition w-full cursor-pointer"
          >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M17 16l4-4m0 0l-4-4m4 4H7"
              />
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8v8" />
            </svg>
            Выход
          </button>
        </li>
      </ul>
    </nav>
  </aside>
</template>

<script setup>
import { useRouter } from 'vue-router'
import { useAuthStore } from '@/stores/authStore'

const router = useRouter()
const authStore = useAuthStore()

const logout = async () => {
  await authStore.logout()
  router.push('/')
}
</script>
