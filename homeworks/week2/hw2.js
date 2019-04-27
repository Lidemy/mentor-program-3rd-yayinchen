function capitalize(str) {
  const capStr = str[0].toUpperCase() + str.substring(1, str.lenth);
  return capStr;
}

console.log(capitalize('hello'));
