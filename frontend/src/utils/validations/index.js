import * as functions from './functions'
/**
 * @param {Array} names
 * @returns {Array<Function>}
 */
export const mapValidations = (names) => {
  const map = []
  names.map(name => {
    map[name] = functions[name]
  })
  return map
}
