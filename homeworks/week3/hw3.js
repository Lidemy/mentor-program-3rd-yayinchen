function isPrime(n) {
  if (n === 1) return false;
  if (n > 1) {
    for (let i = 2; i <= Math.sqrt(n); i += 1) {
      if (n % i === 0) {
        return false;
      }
    }
  }
  return true;
}

module.exports = isPrime;
