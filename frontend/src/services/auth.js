import $http from 'src/settings/http'

export default {

  signIn(credentials) {
    return $http.post('login', credentials)
  },
  signOut() {
    return $http.post('logout')
  }
}
