## 什麼是 DOM？
DOM ， document object model，DOM 會依照 html 的標籤結構，形成一層一層的 DOM 節點，可以把 html 文件中的標記轉換成物件來解讀，是 html 與 javascript 溝通的橋樑，讓 javascript 可以透過 DOM 來改變 html 內容。除了 html ，其他標記的文件如 XML ，也能將標記的內容變成層層的結構關係，能讓程式語言選取當中的元素，改變其中的內容，改變 css ，甚至新增或刪除元素、監聽事件和儲存資訊在瀏覽器中，而 javascript 是最常用來存取 DOM 的程式語言。 

## 事件傳遞機制的順序是什麼；什麼是冒泡，什麼又是捕獲？
事件傳遞時，會依照 DOM 的節點，從最外層由上往下傳遞，稱為捕獲階段 capture phase；到達所選取的元素時，啟動事件執行功能，稱為 target phase ； 最後事件仍會由下往上傳遞到最外層，稱為 bubbling phase 。

## 什麼是 event delegation，為什麼我們需要它？
事件代理 event delegation ，由於冒泡的機制，事件監聽可以放在較外層，再利用瀏覽器的回傳，取得點擊的資訊，除了節省程式碼重複的情形，而且還能處理動態新增按鈕的狀況。

## event.preventDefault() 跟 event.stopPropagation() 差在哪裡，可以舉個範例嗎？
event.preventDefault() 是停止預設的動作，常用在表單驗證、阻止超連結，並不會阻止事件傳遞；event.stopPropagation() 仍會執行點擊的功能，但是停止事件的傳遞，若外層有事件監聽，則不會被觸發。