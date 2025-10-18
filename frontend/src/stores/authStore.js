import { defineStore } from 'pinia'
import { ref } from 'vue'
import { AuthAPI } from '@/api/auth'

export const useAuthStore = defineStore('auth', () => {
  // Загружаем из sessionStorage, если есть
  const user = ref(JSON.parse(sessionStorage.getItem('user')) || null)
  const token = ref(sessionStorage.getItem('token') || null)

  function setAuthData(newUser, newToken) {
    user.value = newUser
    token.value = newToken
    sessionStorage.setItem('user', JSON.stringify(newUser))
    sessionStorage.setItem('token', newToken)
  }

  async function logout() {
    try {
      await AuthAPI.logout()  // ждём выполнения запроса
    } catch (err) {
      console.warn('Ошибка logout', err)
    } finally {
      user.value = null
      token.value = null
      sessionStorage.removeItem('user')
      sessionStorage.removeItem('token')
    }
  }

  return { user, token, setAuthData, logout }
})
