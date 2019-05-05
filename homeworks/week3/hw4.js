function isPalindromes(str) {
  for (let i = 1; i <= (str.length) / 2; i += 1) {
    if (str[i - 1] !== str[str.length - i]) {
      return false;
    }
  }
  return true;
}

module.exports = isPalindromes;
