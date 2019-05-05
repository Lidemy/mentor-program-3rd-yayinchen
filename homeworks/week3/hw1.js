function stars(n) {
  const result = [];
  for (let i = 1; i <= n; i += 1) {
    const item = '*'.repeat(i);
    result.push(item);
  }
  return result;
}

module.exports = stars;
