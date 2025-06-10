import $http from 'src/settings/http'

const API_ENDPOINT = 'user'

export default {

  all(data) {
    return $http.get(API_ENDPOINT, { params: data })
  },

  find(id) {
    return $http.get(API_ENDPOINT + '/' + id)
  },

  create(model) {
    return $http.post(API_ENDPOINT, model)
  },

  update(model) {
    return $http.put(API_ENDPOINT + '/' + model.id, model)
  },

  delete(id) {
    return  $http.delete(API_ENDPOINT + '/' + id)
  },
}
