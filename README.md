<div align="center">
   <img src="web/img/logo.png" style="width: 200px; height: auto;">
   <h1 align="center">🚗 CarLog járműköltés nyilvántartó (Yii2)</h1>
</div>

<p align="center">
  <strong>Egyszerű, gyors és modern jármű költségkezelő rendszer Yii2 PHP keretrendszerrel.</strong><br>
  Kövesd tankolásaidat, javításaidat, egyéb költéseidet, és lásd tisztán az összesített kiadásaidat!
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Yii2-Basic-blueviolet" alt="Yii2">
  <img src="https://img.shields.io/badge/PHP-%5E8.3-blue" alt="PHP">
  <img src="https://img.shields.io/badge/Bootstrap-5-lightblue" alt="Bootstrap">
  <img src="https://img.shields.io/badge/MySQL-supported-yellow" alt="MySQL">
</p>

---

## 🔧 Fő funkciók

- ✅ Felhasználói regisztráció és bejelentkezés (session alapú)
- 🚘 Több jármű hozzáadása (márka, típus, évjárat)
- 💸 Költések rögzítése: tankolás, javítás, egyéb kiadások
- 📅 Költések dátum szerinti listázása
- 🎯 Autó szerinti szűrés és összesítés (összköltés)
- 🎨 Bootstrap + Bootstrap Icons UI
- ⚠️ SweetAlert2 törlés megerősítés

---

## 🚀 Telepítés

1. Klónozd a repót:
   ```bash
   git clone https://github.com/MarBot001/carlog.git
   cd carlog
   ```

2. Telepítsd a függőségeket:
   ```bash
   composer install
   ```

3. Állítsd be az adatbázist (`config/db.php`):
   ```php
   return [
       'class' => 'yii\db\Connection',
       'dsn' => 'mysql:host=localhost;dbname=carlog',
       'username' => 'root',
       'password' => '',
       'charset' => 'utf8',
   ];
   ```

4. Adatbázis tábláinak létrehozása:
   ```sql
   CREATE TABLE `user` (
   `id` INT NOT NULL AUTO_INCREMENT,
   `name` VARCHAR(100) NOT NULL,
   `email` VARCHAR(100) NOT NULL UNIQUE,
   `password_hash` VARCHAR(255) NOT NULL,
   `auth_key` VARCHAR(255),
   `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
   PRIMARY KEY (`id`)
   ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
   
   CREATE TABLE `car` (
   `id` INT NOT NULL AUTO_INCREMENT,
   `user_id` INT NOT NULL,
   `brand` VARCHAR(100) NOT NULL,
   `model` VARCHAR(100) NOT NULL,
   `edition` VARCHAR(100) NOT NULL,
   `year` YEAR NOT NULL,
   PRIMARY KEY (`id`),
   FOREIGN KEY (`user_id`) REFERENCES `user`(`id`) ON DELETE CASCADE
   ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
   
   CREATE TABLE `expense` (
   `id` INT NOT NULL AUTO_INCREMENT,
   `car_id` INT NOT NULL,
   `type` ENUM('fuel', 'cost', 'repair') NOT NULL,
   `title` VARCHAR(255) NOT NULL,
   `amount` DECIMAL(10,2) NOT NULL,
   `date` DATE NOT NULL,
   `description` TEXT,
   `icon` VARCHAR(100),
   PRIMARY KEY (`id`),
   FOREIGN KEY (`car_id`) REFERENCES `car`(`id`) ON DELETE CASCADE
   ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
      ```

5. Indítsd el a szervert:
   ```bash
   php yii serve
   ```

---

## 🛠️ Használt technológiák

- **Yii2 Basic** keretrendszer
- **PHP 8.2+**
- **Bootstrap 5** (CDN)
- **MySQL / MariaDB**
- **SweetAlert2**
- **Bootstrap Icons**
- **ActiveRecord ORM**


---

## 💡 Tippek fejlesztéshez

- Fejlesztés közben használj `debug` modult
- A SweetAlert2 `registerJs()` metódussal gyorsan integrálható
- Töltsd fel saját Bootstrap témát is, ha egyedibb UI kell

---

## 🧑‍💻 Készítette

- **Fejlesztő**: Vincze Marcell ✌️
- **Licenc**: MIT

---
