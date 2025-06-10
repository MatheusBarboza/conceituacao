import { LocalStorage } from 'quasar'

const parse = (value) => value === 'undefined' ? undefined : value

export const read = (index) => {
  return parse(LocalStorage.getItem(index))
}

export const write = (index, value) => {
  LocalStorage.setItem(index, value)
}

export const remove = (index) => {
  LocalStorage.removeItem(index)
}
