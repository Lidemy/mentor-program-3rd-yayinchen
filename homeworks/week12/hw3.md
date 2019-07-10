## 請說明 SQL Injection 的攻擊原理以及防範方法
SQL injection 攻擊原理：
	在輸入區中輸入特殊字串，改變 sql 指令。如帳號輸入 ' or 1=1 -- ，讓整個sql指令變為 select * from users where username='' or 1=1 -- 'password=''，可跳過帳號密碼驗證，直接登入，使用帳號為資料庫中第一筆user。
防範方法： 
	prepared statement ，將 sql 語法寫成類似函式可重複使用，使用時帶入參數，避免使用者輸入的特殊符號影響 sql 指令。
	$stmt = $conn->prepare("select * from users where username=? and password=?");  
	$stmt->bind_param("ss", $username, $password);
	$stmt->execute();  
	$result = $stmt->get_result();
	if($result->num_rows > 0) {
    	$row = $result->fetch_assoc();
    	⋯⋯
	}

## 請說明 XSS 的攻擊原理以及防範方法
XSS (cross-site scripting) 攻擊原理：
	在網頁輸入區輸入特殊字串，導致輸出時執行javascript，能對網頁做任何事，如竄改頁面、竄改連結、偷cookie等 
防範方法： 
	escape 跳脫特殊符號，echo htmlspecialchars($str, ENT_QUOTES, ‘utf-8’)。

## 請說明 CSRF 的攻擊原理以及防範方法
CSRF 攻擊原理：
	利用瀏覽器在發送 request 時會自動帶上相關的 cookie ，仿造使用者發出某些執行指令的 request ，若是登入的狀態，即可執行該動作。
防範方法：
	1. 限制發出 request 的 domain 必須是該網站的 domain 。
	2. 增加輸入驗證碼。
	3. 送出的表單帶入隨機且隱藏的 token ， token 會存在 session 中，伺服器會驗證送出的表單的 token。