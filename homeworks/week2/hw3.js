function reverse(str) {
  let newStr = '';
  for (let i = (str.length - 1); i >= 0; i -= 1) {
    newStr += str[i];
  }
  return newStr;
}

console.log(reverse('hello'));
