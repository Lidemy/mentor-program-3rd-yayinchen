## CSS 預處理器是什麼？我們可以不用它嗎？
可以用更簡潔、富語意、容易維護的預處理器語法來寫 CSS ，如同 jQuery 對於 javascript ，所以 CSS 預處理器非必需使用。

## 請舉出任何一個跟 HTTP Cache 有關的 Header 並說明其作用。
cache-control: no-cache
每次都會發 request 尋問 server 該檔案有無更新，可確保 client 造訪網頁時，都是最新的網頁。

## Stack 跟 Queue 的差別是什麼？
Stack 是堆疊，後進先出，如同復原或上一頁功能； Queue 是佇列，先進先出，如同排隊。

## 請去查詢資料並解釋 CSS Selector 的權重是如何計算的（不要複製貼上，請自己思考過一遍再自己寫出來）
權重分為五個位階，沒設定過為 0 ，該位階出現 n 次設定，則該位階為 n ，從位階最高開始比大小，較大者的設定可以覆蓋較小的設定，為最終表現的樣式，若相同則往下一位階比大小，若五位階都相同，則後出現的為最終表現的樣式。五位階為：
!important：奧義，特殊例外，建議少用
> inline style：直接寫在 html 的標籤裡，維護不易，少用
> ID：不可重複，但同一html的標籤可以有多個 ID ，常用
> Class/psuedo-class(偽類)/attribute（屬性選擇器）： 最常用，可重複，設定中出現 n 次即為 n
> Element：html的標籤
* 沒有位階，只要上面有設定即覆蓋