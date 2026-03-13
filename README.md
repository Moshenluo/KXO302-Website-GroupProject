# Desert Oasis - Online Art Trading Platform

## 📖 项目简介

**KXO302 课程小组项目**

这是一个基于 PHP 的在线艺术品交易平台，提供艺术品展示、浏览、购买、评论等功能。项目采用传统的 LAMP（Linux + Apache + MySQL + PHP）架构开发。

| 项目 | 信息 |
|------|------|
| **课程** | KXO302 |
| **项目类型** | 小组作业（Group Project） |
| **技术栈** | PHP, MySQL, HTML, CSS, JavaScript, Bootstrap |
| **作者** | 唐翊杰 等 |
| **学校** | 上海海洋大学 爱恩学院 |
| **版本** | V3.0 |

---

## 🎨 功能特性

### 用户功能
- 👤 用户注册与登录
- 🖼️ 艺术品浏览与搜索
- 🛒 购物车功能
- 📦 订单管理
- 💬 评论与点赞
- ❤️ 个人收藏

### 艺术家功能
- 🎨 个人作品管理
- 📊 作品分类展示（数字设计、素描、传统绘画）
- 📈 销售统计

### 管理员功能
- 🔧 用户管理
- 🖼️ 艺术品审核与管理
- 📦 订单处理
- 📊 平台数据统计

---

## 📁 项目结构

```
KXO302/
├── index.php                  # 首页
├── login.php                  # 登录页面
├── signup.php                 # 注册页面
├── product.php                # 产品列表
├── single.php                 # 产品详情
├── shoppingcart.php           # 购物车
├── order.php                  # 订单页面
├── myorder.php                # 我的订单
├── search_results.php         # 搜索结果
├── artist-personal.php        # 艺术家个人页面
├── artist-forpublic.php       # 艺术家公开页面
├── admin.php                  # 管理后台
├── dbconn.php                 # 数据库连接
├── header.php                 # 页头组件
├── css/                       # 样式文件
│   ├── bootstrap.css
│   ├── style.css
│   ├── animate.css
│   └── ...
├── images/                    # 图片资源
│   ├── art_picture/          # 艺术品图片
│   └── ...
└── .gitignore                # Git 忽略配置
```

---

## 🚀 快速开始

### 环境要求

- **PHP**: 7.4+
- **MySQL**: 5.7+ 或 MariaDB
- **Web Server**: Apache 或 Nginx
- **浏览器**: Chrome, Firefox, Edge 等

### 安装步骤

#### 1. 克隆项目

```bash
git clone https://github.com/Moshenluo/KXO302-Website-GroupProject.git
cd KXO302-Website-GroupProject/KXO302
```

#### 2. 配置数据库

创建 MySQL 数据库并导入 SQL 文件（如有）：

```sql
CREATE DATABASE desert_oasis;
-- 导入提供的 SQL 文件
```

#### 3. 配置数据库连接

编辑 `dbconn.php` 文件，修改数据库连接信息：

```php
<?php
$servername = "localhost";
$username = "root";
$password = "your_password";
$dbname = "desert_oasis";

$conn = new mysqli($servername, $username, $password, $dbname);
?>
```

#### 4. 启动 Web 服务器

**使用 PHP 内置服务器（开发环境）**：

```bash
php -S localhost:8000
```

**或使用 XAMPP/WAMP**：
- 将项目复制到 `htdocs` 或 `www` 目录
- 启动 Apache 和 MySQL
- 访问 `http://localhost/KXO302`

#### 5. 访问网站

打开浏览器访问：`http://localhost:8000` 或 `http://localhost/KXO302`

---

## 🛠️ 技术栈

### 后端
- **PHP**: 服务器端逻辑
- **MySQL**: 数据库管理
- **Apache/Nginx**: Web 服务器

### 前端
- **HTML5**: 页面结构
- **CSS3**: 样式设计
- **JavaScript**: 交互逻辑
- **Bootstrap**: 响应式框架
- **Font Awesome**: 图标库

### 开发工具
- **Git**: 版本控制
- **PhpStorm/VS Code**: 代码编辑器

---

## 📸 页面预览

### 首页
艺术品展示、搜索功能、热门推荐

### 产品详情
艺术品详细信息、评论、点赞、购买

### 购物车
商品管理、数量调整、结算

### 个人中心
订单管理、收藏管理、个人信息

---

## 📋 数据库设计

### 主要数据表

| 表名 | 说明 |
|------|------|
| `users` | 用户信息表 |
| `artists` | 艺术家信息表 |
| `artworks` | 艺术品信息表 |
| `categories` | 分类表 |
| `orders` | 订单表 |
| `order_details` | 订单详情表 |
| `comments` | 评论表 |
| `likes` | 点赞表 |
| `cart` | 购物车表 |

---

## 🔒 安全说明

### 生产环境部署建议

1. **数据库凭据**：不要将真实密码提交到仓库
2. **HTTPS**：启用 SSL/TLS 加密
3. **输入验证**：防止 SQL 注入和 XSS 攻击
4. **文件上传**：限制上传文件类型和大小
5. **会话管理**：使用安全的 session 配置

---

## 📝 使用说明

### 用户注册与登录

1. 点击首页右上角"注册"按钮
2. 填写用户名、邮箱、密码等信息
3. 注册成功后登录

### 浏览艺术品

1. 首页浏览推荐作品
2. 使用搜索功能查找特定作品
3. 按分类筛选（数字设计、素描、传统绘画）

### 购买流程

1. 浏览艺术品详情页
2. 点击"加入购物车"
3. 进入购物车页面
4. 调整数量后点击"结算"
5. 填写收货信息并确认订单

### 管理订单

1. 登录后进入"我的订单"
2. 查看订单状态
3. 确认收货或申请退款

---

## 👥 项目成员

| 姓名 | 学号 | 负责模块 |
|------|------|---------|
| 唐翊杰 | 2191146 | [待填写] |
| [成员 2] | [学号] | [待填写] |
| [成员 3] | [学号] | [待填写] |

---

## 📚 课程信息

- **课程代码**: KXO302
- **学期**: 2024-2025
- **项目类型**: Group Project
- **版本**: V3.0

---

## 🐛 已知问题

- [ ] [待填写]
- [ ] [待填写]

---

## 🤝 贡献指南

欢迎提交 Issue 和 Pull Request！

1. Fork 本仓库
2. 创建特性分支 (`git checkout -b feature/AmazingFeature`)
3. 提交更改 (`git commit -m 'Add some AmazingFeature'`)
4. 推送到分支 (`git push origin feature/AmazingFeature`)
5. 开启 Pull Request

---

## 📄 许可证

本项目为 KXO302 课程作业，仅供学习参考使用。

---

## 📧 联系方式

- **作者**: 唐翊杰
- **学号**: 2191146
- **Email**: 1411795718@qq.com
- **GitHub**: [@Moshenluo](https://github.com/Moshenluo)

---

**最后更新**: 2026-03-13
