<template>
  <div class="flex flex-col items-center justify-center min-h-[70vh] px-4">
    <div class="w-full max-w-sm bg-white border border-gray-300 shadow-md rounded-lg p-6">
      <h2 class="text-xl font-bold text-center text-gray-700 mb-4">Вход в систему</h2>
      <form @submit.prevent="login" class="flex flex-col gap-4">
        <div>
          <label class="block text-sm font-medium text-gray-600 mb-1">e-mail</label>
          <input
            v-model="email"
            type="email"
            placeholder="Введите email"
            class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500"
          />
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-600 mb-1">Пароль</label>
          <input
            v-model="password"
            type="password"
            placeholder="Введите пароль"
            class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500"
          />
        </div>

        <button
          type="submit"
          class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-md transition"
        >
          Войти
        </button>

        <p v-if="error" class="text-red-500 text-sm text-center mt-2">{{ error }}</p>
      </form>
    </div>
  </div>
</template>


<script setup>
import { ref } from 'vue'
import { AuthAPI } from '@/api/auth'
import { useAuthStore } from '@/stores/authStore'
import { useRouter } from 'vue-router'

const authStore = useAuthStore()
const email = ref('')
const password = ref('')
const error = ref('')
const router = useRouter()

// Закрытие формы по ESC
document.addEventListener('keydown', (e) => {
  if (e.key === 'Escape') {
    window.location.reload()
  }
})

const login = async () => {
  if (!email.value || !password.value) {
    error.value = 'Введите логин и пароль'
    return
  }

  try {
    const { data } = await AuthAPI.login(email.value, password.value)
    authStore.setAuthData(data.user, data.token)
    alert('Вход выполнен успешно!')

    router.push('/admin')
  } catch (err) {
    error.value =
      err.response?.status === 401 ? 'Неверный логин или пароль' : 'Ошибка подключения к серверу'
  }
}
</script>

