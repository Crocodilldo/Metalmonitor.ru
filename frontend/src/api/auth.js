import api from './api'

export const AuthAPI = {
  login(email, password) {
    return api.post('/login', { email, password })
  },

  logout() {
    return api.post('/admin/logout')
  },
}
