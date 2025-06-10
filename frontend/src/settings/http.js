import axios from 'axios'
import { useAuthStore } from 'stores/auth'

/**
 * @type {Axios}
 */
const $http = axios.create({ baseURL: process.env.VITE_APP_REST_BASE_URL })

$http.interceptors.request.use((config) => {
  const auth = useAuthStore()
  const token = auth.getToken || null
  if (token)
    config.headers['Authorization'] = `Bearer ${token}`
  
  return config
}, (error) => {
  return Promise.reject(error)
})

export default $http
