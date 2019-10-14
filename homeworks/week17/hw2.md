``` js
for(var i=0; i<5; i++) {
  console.log('i: ' + i)
  setTimeout(() => {
    console.log(i)
  }, i * 1000)
}
```
輸出順序：i:0、i:1、i:2、i:3、i:4、5、5、5、5、5

1) 進入 for 迴圈， var i 為全域變數，
2) 第一圈， i=0 ，執行 console.log('i: ' + i) ，輸出 i:0，setTimeout(...) 放入 webapis ，等待零秒， cb 放入 callback queue；
3) 第二圈， i=1 ，執行 console.log('i: ' + i) ，輸出 i:1，setTimeout(...) 放入 webapis ，等待一秒， cb 放入 callback queue；
4) 第三圈， i=2 ，執行 console.log('i: ' + i) ，輸出 i:2，setTimeout(...) 放入 webapis ，等待二秒， cb 放入 callback queue；
5) 第四圈， i=3 ，執行 console.log('i: ' + i) ，輸出 i:3，setTimeout(...) 放入 webapis ，等待三秒， cb 放入 callback queue；
6) 第五圈， i=4 ，執行 console.log('i: ' + i) ，輸出 i:4，setTimeout(...) 放入 webapis ，等待四秒， cb 放入 callback queue；
7) i=5 ，迴圈結束， stack 清空，event loop 將第一個 setTimeout(...) 的 cb 從 callback queue 移至 call stack ，執行 console.log(i) ， 輸出 5 ；
8) event loop 將第二個 setTimeout(...) 的 cb 從 callback queue 移至 call stack ，執行 console.log(i) ， 輸出 5 ；
9) event loop 將第三個 setTimeout(...) 的 cb 從 callback queue 移至 call stack ，執行 console.log(i) ， 輸出 5 ；
10) event loop 將第四個 setTimeout(...) 的 cb 從 callback queue 移至 call stack ，執行 console.log(i) ， 輸出 5 ；
11)event loop 將第五個 setTimeout(...) 的 cb 從 callback queue 移至 call stack ，執行 console.log(i) ， 輸出 5 ；
12) 全部執行完畢。