## 請說明雜湊跟加密的差別在哪裡，為什麼密碼要雜湊過後才存入資料庫
雜湊是多對一函數，只能單向推導，不能從結果回推輸入；加密是一對一函數，解密後可以得知輸入是什麼。
資料庫要存雜湊過後的密碼，如果資料外洩時，仍能保護密碼不被曝光。

## 請舉出三種不同的雜湊函數
md5、SHA-256、SHA-1

## 請去查什麼是 Session，以及 Session 跟 Cookie 的差別
Session 是儲存在 server 端的有關 request 端的少量資訊， cookie 是存在 request 端的少量資訊。因為資訊安全的緣故， 不宜將資料儲存在 request 端，減少被篡改的可能，故資料多儲存在 server ，通常 cookie 只存 Session_id ，能讓 server 端辨識使用者。

##  `include`、`require`、`include_once`、`require_once` 的差別
include 和 require 都能將不同的 php 檔案串接在一起， 兩者的差異是： require 發生錯誤時會停止程式運作；而 include 會產生一個 Warning，但是繼續執行之後的程式碼。
include_once 和 require_once 都是限定同一檔案只能引進一次。