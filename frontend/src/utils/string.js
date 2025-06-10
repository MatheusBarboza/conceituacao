
export const parseStringTemplate = (str, obj) => {
  return str.replace(/\$\{([^}]+)\}/g, (match, key) => {
    return obj[key] !== undefined ? obj[key] : '';
  });
}
