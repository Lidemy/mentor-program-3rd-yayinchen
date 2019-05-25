## 請找出三個課程裡面沒提到的 HTML 標籤並一一說明作用。
一種清單的表示方法，前面無符號，可以呈現縮排的效果，<dt>標題中的字是粗體
<dl>
    <dt>標題A</dt>
        <dd>內容A-1</dd>
        <dd>內容A-2</dd>
    <dt>標題B</dt>
        <dd>內容B-1</dd>
</dl>

## 請問什麼是盒模型（box modal）
佈局版面時，將所有元素都表示成一個個矩形的盒子，可以設定每個盒子的大小、位置及其他屬性。盒子有四層，從外到內是： margin, border, padding, content ，預設的高寬是 content-box ，其餘寬度外加；也可以將 box-sizing 設定成 border-box ，只有 margin 寬度外加。

## 請問 display: inline, block 跟 inline-block 的差別是什麼？
inline 可與其他元素在同一行，但不能影響上下行元素的位置，多用在內文中的重點或超連結； block 只能自成一行，能設定高度，運用廣泛； inline-block 可將 block 排列在同一行，又能設定高度，多用在橫向的選單列表。

## 請問 position: static, relative, absolute 跟 fixed 的差別是什麼？
static 是預設的定位方法，會按照規則將元素一個一個佈局，大部份的排版都是如此； relative 在 static 定位的基礎上，再做位置上的調整，但不影響其他元素的位置，例如： top: 20px ，會在原來 static 位置往下移動 20px ，其他元素位置不變，可用在凸顯該元素。 fixed 定位在 viewport 上會固定在某個位置，不管頁面怎麼拉動都是如此，例如導覽列或是討厭的廣告；, absolute 定位可自定參考點，再依參考點移動位置，參考點在該元素的文件架構中往上層尋找 position: relative ，若無即以 body 為參考點，可用在關閉按鈕的位置。另外，fixed 和 absolute 定位自外於 static 定位，後面的元素會遞補。
