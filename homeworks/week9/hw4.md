## 資料庫欄位型態 VARCHAR 跟 TEXT 的差別是什麼
VARCHAR 可以設定長度，節省儲存空間，一般儲存較短的字串。 TEXT 就是儲存文字。

## Cookie 是什麼？在 HTTP 這一層要怎麼設定 Cookie，瀏覽器又會以什麼形式帶去 Server？
Cookie 是儲存在客戶端電腦中關於某網站或網頁的少量資訊，是一種小型的文字檔案，多用在保存狀態資訊。客戶端電腦造訪某網站或網頁，發送 request 給該網站或網頁的 server ， server 回傳的 response 中夾帶 Cookie ， Cookie 存在客戶端電腦中，若再次對該網站或網頁發送 request ，瀏覽器會將 cookie 帶入到 request 的 header 中。

## 我們本週實作的會員系統，你能夠想到什麼潛在的問題嗎？
只要偽造 cookie 就可以在網站通行無阻，而且 cookie 還是帶 id ，從 1 開始的連續數字，根本不用猜，沒有加密，後端也沒有其他再確認機制，毫無安全性可言。
