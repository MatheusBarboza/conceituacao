import { defineStore } from 'pinia'
import { read, write, remove } from 'src/utils/storage'

export const useAuthStore = defineStore('auth', {
  state: () => ({
    user: read('user') || null,
    token: read('token') || null,
  }),
  actions: {
    setUser(user) {
      this.user = user
      write('user', user)
    },
    setToken(token) {
      this.token = token
      write('token', token)
    },

    clearAuth() {
      this.user = null
      this.token = null

      remove('user')
      remove('token')
    },
  },
  getters: {
    isAuthenticated: (state) => !!state.token,
    getUser: (state) => state.user,
    getToken: (state) => state.token,
    isAdmin: (state) => state.user.profiles
      .find(profile => profile.name === 'admin'),
  },
})