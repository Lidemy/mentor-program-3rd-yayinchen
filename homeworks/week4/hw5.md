## 請以自己的話解釋 API 是什麼
API (Application Programming Interface)，某些公司提供 API ，即釋出自己的部分數據或功能，讓其他人能夠取用。提供 API 者，會有文件讓取用者了解如何串接 API。

## 請找出三個課程沒教的 HTTP status code 並簡單介紹
401 Unauthorized 未認證，請求需要用戶驗證
403 Forbidden 拒絕執行請求
501 Not Implemented 不支援目前請求所需要的某個功能，如網路服務API的新功能

## 假設你現在是個餐廳平台，需要提供 API 給別人串接並提供基本的 CRUD 功能，包括：回傳所有餐廳資料、回傳單一餐廳資料、刪除餐廳、新增餐廳、更改餐廳，你的 API 會長什麼樣子？請提供一份 API 文件。
Base URL: https://lidemy-restaurants.com

| 說明    | Method | path       | 參數                | 範例             |
|--------|--------|------------|----------------------|----------------|
| 獲取所有餐廳資料 | GET    | /restaurants     | _limit:限制回傳資料數量           | /restaurants?_limit=5 |
| 獲取單一餐廳資料 | GET    | /restaurants/:id | 無                    | /books/10      |
| 新增餐廳   | POST   | /restaurants     | name: 餐廳名 | 無              |
| 刪除餐廳   | DELETE   | /restaurants/:id     | 無 | 無              |
| 更改餐廳   | PATCH   | /restaurants/:id     | name: 餐廳名 | 無              |

餐廳資料內容格式：
{
	id:'0024'
	name:'mos burger'
	category:'burger'
	address:'taipei'
}

