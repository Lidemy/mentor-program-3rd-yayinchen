``` js
var a = 1
function fn(){
  console.log(a)
  var a = 5
  console.log(a)
  a++
  var a
  fn2()
  console.log(a)
  function fn2(){
    console.log(a)
    a = 20
    b = 100
  }
}
fn()
console.log(a)
a = 10
console.log(a)
console.log(b)
```

輸出順序：undefined、5、6、20、1、10、100

1) 創建 global EC {} ，內有 VO {} ，宣告變數 a: undefined, 函式 fn ；
2) 執行程式碼， global VO 中的變數賦值 a: 1 ；執行 fn() ；
3) 創建 fn EC {} ，內有 AO {} ，變數 a: undefined, 函式 fn2 ；
4) 執行程式碼， console.log(a) ，變數 a 先在 fn AO 找，內有已宣告未賦值變數 a: undefined ，輸出 undefined ；
5) 執行程式碼， fn AO 中的變數賦值 a: 5 ； console.log(a) ，變數 a 先在 fn AO 找，內有變數 a: 5 ，輸出 5 ；
6) 執行程式碼， a++ ， fn AO 中的變數賦值 a: 6 ；執行 fn2() ；
7) 創建 fn2 EC {} ，內有 AO {} ，無宣告任何變數；
8) 執行程式碼， console.log(a) ，變數 a 先在 fn2 AO 找，找不到往上層找， fn AO 找到變數 a: 6 ，輸出 6 ；
9) 執行程式碼， 賦值 a 但 fn2 AO 中找不到 a ，往上層找， fn AO 找到變數賦值 a: 20 ；
10) 執行程式碼， 賦值 b 但 fn2 AO 中找不到 b ，往上層找，fn AO 中找不到 b ，往上層找， 已在最上層的 global VO 中仍然沒有，非嚴格模式，在 global VO 中宣告並賦值變數 b: 100 ；
11) fn2 執行完畢，清掉 fn2 EC ；
12) 執行程式碼， console.log(a) ，變數 a 先在 fn AO 找，內有變數 a: 20 ，輸出 20 ；
13) fn 執行完畢，清掉 fn EC ；
14) 執行程式碼， console.log(a) ，在 global VO 找到變數 a: 1 ，輸出 1 ；
15) 執行程式碼， global VO 賦值變數 a: 10 ；
16) 執行程式碼， console.log(a) ，在 global VO 找到變數 a: 10 ，輸出 10 ；
17) 執行程式碼， console.log(b) ，在 global VO 找到變數 b: 100 ，輸出 100 ；
18) 執行完畢，清掉 global EC 。
