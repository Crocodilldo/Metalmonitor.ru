// stores/productStore.js
import { defineStore } from 'pinia'
import axios from 'axios'

export const useProductStore = defineStore('productStore', {
  state: () => ({
    products: [],
    isLoading: false,
    error: null,
    lastQuery: {}, // теперь объект, для search + category_id
  }),

  actions: {
    async fetchProducts(query = {}) {
      this.isLoading = true
      this.error = null
      try {
        // Проверяем, не совпадает ли текущий запрос с предыдущим
        if (
          JSON.stringify(this.lastQuery) === JSON.stringify(query) &&
          this.products.length > 0
        ) {
          this.isLoading = false
          return
        }

        const response = await axios.get('http://localhost/api/products', { params: query })
        // const response = await axios.get('/api/products', { params: query })
        this.products = response.data.data || []
        this.lastQuery = query
      } catch (err) {
        console.error('Ошибка загрузки продуктов:', err)
        this.error = 'Не удалось загрузить товары'
      } finally {
        this.isLoading = false
      }
    },
  },
})
