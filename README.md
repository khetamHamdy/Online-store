# 🛒 Online Store System - Laravel Full-Stack Project

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-00000F?style=for-the-badge&logo=mysql&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-563D7C?style=for-the-badge&logo=bootstrap&logoColor=white)

نظام متجر إلكتروني متكامل (Full-Stack) احترافي، تم تطويره باستخدام إطار العمل **Laravel**. يهدف المشروع إلى تقديم حلول برمجية متطورة للتجارة الإلكترونية تشمل تجربة مستخدم سلسة ولوحة تحكم شاملة للمسؤولين.

---

## ✨ المميزات الرئيسية (Key Features)

### 👤 تجربة المستخدم (Customer Experience)
* **Dynamic Product Catalog:** عرض المنتجات بطريقة تفاعلية مع إمكانية التصفية حسب التصنيف.
* **Shopping Cart System:** سلة تسوق ذكية تعتمد على (Sessions) لحفظ المنتجات مؤقتاً.
* **Secure Auth System:** نظام تسجيل دخول وحماية بيانات المستخدمين.
* **Checkout Workflow:** دورة كاملة لطلب المنتج تشمل بيانات الشحن وتأكيد الطلبية.

### 🔐 لوحة تحكم الإدارة (Admin Dashboard)
* **Inventory Management (CRUD):** تحكم كامل في إضافة، تعديل، وحذف المنتجات مع رفع الصور.
* **Category Management:** تنظيم المتجر من خلال نظام تصنيفات مرن.
* **Order Tracking:** واجهة لمراقبة الطلبات الجديدة وتغيير حالتها (Pending, Completed).
* **Security Middleware:** تأمين صارم للمسارات الحساسة لضمان وصول المسؤولين فقط.

---

## 🛠️ التقنيات المستخدمة (Tech Stack)

* **Backend:** [Laravel Framework](https://laravel.com/) - MVC Architecture.
* **Database:** MySQL - Relational Database Design.
* **Frontend:** Blade Templates, CSS3, JavaScript, Bootstrap 5.
* **Storage:** Laravel File Storage لإدارة صور المنتجات بشكل آمن.

---

## 📂 هيكلية المشروع (Project Architecture)

يتبع المشروع معمارية **Model-View-Controller (MVC)** لضمان فصل المنطق البرمجي عن الواجهات:

* **Models:** التعامل مع قاعدة البيانات والعلاقات (Eloquent ORM).
* **Views:** واجهات المستخدم التفاعلية باستخدام محرك Blade.
* **Controllers:** معالجة الطلبات وربط البيانات بين الـ Model والـ View.

---

## ⚙️ تعليمات التنصيب والتشغيل (Installation)

اتبعي الخطوات التالية لتشغيل المشروع في بيئة العمل المحلية:

1️⃣ **استنساخ المستودع:**
```bash
git clone [https://github.com/khetamHamdy/Online-store.git](https://github.com/khetamHamdy/Online-store.git)
cd Online-store
---

2️⃣ تثبيت المكتبات البرمجية:
composer install
npm install && npm run dev

3️⃣ إعداد ملف البيئة:
- قم بتغيير اسم ملف .env.example إلى .env
- أضف بيانات قاعدة البيانات الخاصة بك في ملف .env

4️⃣ تجهيز قاعدة البيانات:
php artisan key:generate
php artisan migrate --seed

5️⃣ تشغيل السيرفر المحلي:
php artisan storage:link
php artisan serve

الموقع الآن متاح على الرابط: http://127.0.0.1:8000

---

## 👤 المطورة (Author)
Eng. Khetam Hamdy
GitHub: @khetamHamdy
LinkedIn: https://www.linkedin.com/in/khetam-hamdy-a66b96253/

⭐ إذا أعجبك المشروع، لا تنسَ دعمي بـ Star على GitHub!
