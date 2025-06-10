/**
 * @param message
 * @returns {function(*=): *}
 */
export const required = (message) => {
  if (!message) message = 'This field is required'
  return val => (Array.isArray(val) ? !!val.length : !!val) || message
}

/**
 * @param {number} min
 * @param {string} message
 * @returns {Function}
 */
export const min = (min, message) => {
  if (!message) message = `Min of ${min} characters`
  return val => val && val.length >= min || message
}

/**
 * @param {number} max
 * @param {string} message
 * @returns {Function}
 */
export const max = (max, message) => {
  if (!message) message = `Max of ${max} characters`
  return val => val && val.length <= max || message
}

/**
 * @param {string} message
 * @returns {Function}
 */
export const validEmail = (message) => {
  if (!message) message = 'Invalid email'
  return val => val && /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/.test(val) || message
}
