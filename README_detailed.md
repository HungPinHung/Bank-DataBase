# my-database-models

## 🔍 專案簡介
**my-database-models** 是一款模擬登入驗證系統的純前端應用，涵蓋前端登入流程、使用者身份模擬、以及基本的使用者介面設計。此專案設計為練習帳號驗證邏輯與模組化程式開發，同時展示前端開發者的程式結構能力與 UI/UX 設計思維。

## 🎯 開發動機
在許多前端專案中，「登入與驗證」是最常見的流程之一。本專案旨在練習如何在無後端支援的環境下，模擬使用者登入的流程，並進一步思考如何將功能與樣式模組化，便於未來擴充與整合進大型系統中。


## 🧱 系統架構

```
my-database-models/
├── index.html             主頁面（登入成功後顯示）
├── login.html             登入頁面
├── home.js                主頁邏輯
├── login.js               登入頁邏輯
├── identifier.js          身份驗證模組
├── home.css               主頁樣式
├── login.css              登入樣式
├── web_config.json        前端用設定檔
└── logo.png               頁面用圖示
```

## 🚀 功能亮點

### 🔐 登入驗證
- 基礎表單驗證（欄位不能為空）
- 自動提示錯誤訊息
- 導向主頁面（模擬登入成功）

### 💾 身份管理
- 使用 `localStorage` 儲存登入資訊（可模擬身份狀態）
- 可作為未來 API 認證 token 的替代原型

### ⚙ 設定檔控制
- 使用 `web_config.json` 儲存文字與設定，增強前端可維護性
- 預設帳號密碼、顯示文字皆可改由 JSON 控制，實現前端配置外部化

## 🖥️ 畫面展示

### Login Page
```
+----------------------------------------+
|          Welcome to the App            |
|                                        |
|  [ Username           ]                |
|  [ Password           ]                |
|                                        |
|     [  Login  ]   [ Forgot Password ]  |
+----------------------------------------+
```

### Home Page (登入成功後)
```
+----------------------------------------+
|      🎉 Welcome, you are logged in!    |
|                                        |
|  Your session is valid.                |
+----------------------------------------+
```

## 🛠 使用技術

| 技術         | 用途說明 |
|--------------|----------|
| HTML5        | 架構頁面，表單設計 |
| CSS3         | 樣式設計與基本響應式支援 |
| JavaScript   | 表單驗證、事件處理、資料儲存 |
| JSON         | 前端設定資料來源 |
| localStorage | 模擬登入狀態保存 |

## 📦 執行方式

```bash
# 使用 Python 啟動簡易伺服器
cd my-database-models-main
python -m http.server

# 或使用 Live Server 開啟 login.html
```



## 🌱 未來擴充方向

- 串接 API，實作真實登入與註冊流程
- 加入使用者註冊與「忘記密碼」流程
- 使用 JWT 或 session 控制登入狀態
- 將介面轉為響應式設計（RWD）
- 前端重構為 React/Vue 結構
