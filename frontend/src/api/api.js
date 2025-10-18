// src/api/api.js
import axios from 'axios'

const api = axios.create({
  baseURL: 'http://localhost/api', // порт 80
  withCredentials: false,          // Bearer не требует cookies
})

// interceptor добавляет токен из sessionStorage
api.interceptors.request.use((config) => {
  const token = sessionStorage.getItem('token')
  if (token) {
    config.headers.Authorization = `Bearer ${token}`
  } else {
  }
  return config
}, (error) => {
  return Promise.reject(error)
})

export default api
