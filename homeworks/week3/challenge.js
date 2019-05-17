function reverseStoA(str) {
  const sToA = [];
  for (let i = 0; i < str.length; i += 1) {
    sToA.push(str[i]);
  }
  return sToA.reverse().map(Number);
}

function add(str1, str2) {
  const arr1 = reverseStoA(str1);
  const arr2 = reverseStoA(str2);
  const len1 = arr1.length;
  const len2 = arr2.length;
  if (len1 >= len2) {
    for (let i = 1; i <= len1 - len2; i += 1) {
      arr2.push(0);
    }
  } else {
    for (let i = 1; i <= len2 - len1; i += 1) {
      arr1.push(0);
    }
  }
  const result = [];
  let sum = 0;
  let plus = 0;
  for (let i = 0; i < arr1.length; i += 1) {
    sum = arr1[i] + arr2[i] + plus;
    plus = 0;
    result.push(sum % 10);
    if (sum >= 10) {
      plus = 1;
    }
  }
  if (plus === 1) {
    result.push(1);
  }
  return result.reverse().join('');
}

function times(str1, str2) {
  const arr1 = reverseStoA(str1);
  const arr2 = reverseStoA(str2);
  const result = [];
  for (let i = 0; i < arr2.length; i += 1) {
    result.push(Array(i).fill(0));
    let sum = 0;
    let plus = 0;
    for (let j = 0; j < arr1.length; j += 1) {
      sum = arr1[j] * arr2[i] + plus;
      result[i].push(sum % 10);
      plus = parseInt(sum / 10, 10);
    }
    if (plus >= 1) {
      result[i].push(plus);
    }
    result[i] = result[i].reverse().join('');
  }
  let total = result[0];
  for (let i = 1; i < arr2.length; i += 1) {
    total = add(total, result[i]);
  }
  return total;
}

module.exports = times;
