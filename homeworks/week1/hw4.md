## 跟你朋友介紹 Git
t 的基本概念以及基礎的使用（ add, commit, push, pull ）
Git 是一個記錄文字檔案變化的程式，一次儲存的變化（ commit ）會產生一個新的版本， git 會記錄各個版本及其先後順序，又稱版本控制。特別的是，在時間排序的版本鏈上，可以產生分支，分頭進行開發工作，確保開發過程中運行穩定，開發完成後再合併分支。

- 我們將資料夾版本控制初始化，在終端機該資料夾下輸入 ` git init `
- 輸入 ` git add . ` 把所有檔案加入版本控制中。
- 輸入 ` git commit -am “message” ` 建立新版本。
- 更改資料後，重複步驟 2, 3 ，儲存新版本。
- 可時常使用 ` git status ` 查詢 git 現況、 ` git log ` 查詢各個版本
- 輸入 ` git checkout 版本名 ` 切換到其他版本，輸入 ` git checkout master ` 切換到最新版本。
- 輸入 ` git branch 分支名 ` 建立新分支。輸入 ` git branch -v ` 查看有哪些分支，所在分支前標 * 。` git checkout 分支名 ` 切換到該分支。
- 合併分支輸入 ` git merge 分支名 ` 把該分支合併進來現在的分支。通常合併後，刪掉該分支，輸入 ` git branch -d 分支名 ` 。
- 可將檔案上傳至 github 分享。新增 repository 輸入名稱和簡介後得到網址，輸入 ` git remote add origin 網址 ` 上傳檔案。
- 可在 github 下載檔案，下載自己的 repo 輸入 ` git pull origin master ` 。下載別人的檔案，先複製ssh位置，輸入 ` git clone ssh位置 ` ，或是 fork 該檔案到自己帳號下，修改後發起 pull request 請求准許合併，達到貢獻原始碼。
- 遇到衝突時，打開檔案會看到 git 標示的衝突位置，手動修改後，才可產生新版本。

