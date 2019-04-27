function join(str, concatStr) {
  let joinStr = '';
  for (let i = 0; i < str.length; i += 1) {
    joinStr += str[i];
    if (i + 1 < str.length) {
      joinStr += concatStr;
    }
  }
  return joinStr;
}

function repeat(str, times) {
  let repStr = '';
  for (let i = 0; i < times; i += 1) {
    repStr += str;
  }
  return repStr;
}

console.log(join([1, 2, 3], '!'));
console.log(repeat('a', 5));
