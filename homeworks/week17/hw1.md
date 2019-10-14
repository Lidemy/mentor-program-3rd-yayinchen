``` js
console.log(1)
setTimeout(() => {
  console.log(2)
}, 0)
console.log(3)
setTimeout(() => {
  console.log(4)
}, 0)
console.log(5)
```
輸出順序：1、3、5、2、4

1) console.log(1) 放入 call stack ，執行， pop 出 call stack ，輸出 1 ；
2) setTimeout(...) 放入 call stack ，執行， pop 出 call stack ，放入 webapis 啟動計時器，等待零秒呼叫 cb ， cb 放入 callback queue ；
3) 第二步 setTimeout(...) pop 出 call stack 後， console.log(3) 放入 call stack ，執行， pop 出 call stack ，輸出 3 ；
4) setTimeout(...) 放入 call stack ，執行， pop 出 call stack ，放入 webapis 啟動計時器，等待零秒呼叫 cb ， cb 放入 callback queue ；
5) 第四步 setTimeout(...) pop 出 call stack 後， console.log(5) 放入 call stack ，執行， pop 出 call stack ，輸出 5 ；
6) call stack 清空， event loop 將第一個 setTimeout(...) 的 cb 從 callback queue 移至 call stack ，執行 console.log(2) ， pop 出 call stack ，輸出 2 ；
7) call stack 清空， event loop 將第二個 setTimeout(...) 的 cb 從 callback queue 移至 call stack ，執行 console.log(4) ， pop 出 call stack ，輸出 4 ；
8) 全部執行完畢。