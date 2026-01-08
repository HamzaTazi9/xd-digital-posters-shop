# Selfique – Online Store (Backend Development)

## 📦 Projectbeschrijving

Selfique is een online webshop ontwikkeld in PHP als eindproject voor Backend Development.  
Gebruikers kunnen producten bekijken, filteren per categorie, aankopen doen via een winkelmandje,
bestellingen bekijken, reviews plaatsen en hun wachtwoord wijzigen.  
Admins kunnen producten toevoegen, bewerken en verwijderen via een adminpanel.

De applicatie is opgebouwd met PHP, MySQL en PDO, met aandacht voor security (XSS & SQL-injectie)
en een duidelijke scheiding tussen frontend en backend.

## 🔗 Git Repository

https://github.com/HamzaTazi9/xd-digital-posters-shop.git

---

## 🌐 Online URL

❌ Niet online (lokaal volledig werkend)

---

## 👤 Testaccounts

### Admin

- Email: admin@admin.com
- Password: Admin

### User

- Email: user@user.com
- Password: User

---

## 🎥 Demonstratievideo

https://youtu.be/hqT0er_-Zho  
_(Unlisted – toont het volledige gevraagde scenario)_

---

## 📋 Checklist ONLINE STORE ✅

---

## 🔐 Security

- PDO prepared statements tegen SQL-injectie
- htmlspecialchars() tegen XSS
- Sessies voor authenticatie en autorisatie

---

## 🧱 Architectuur (OOP)

- Db-klasse voor databaseconnectie
- SQL enkel in backend PHP-bestanden
- Frontend bevat geen SQL

---

## ⚙️ Installatie (lokaal via MAMP)

1. Plaats het project in:
   htdocs/EINDPROJECT_ONLINESTORE

2. Importeer de database:
   selfique_store.sql via phpMyAdmin

3. Pas de databaseconfig aan in:
   Project-root/classes/Db.php

   Host: localhost  
   User: root  
   Password: root  
   Database: selfique_store

4. Open in de browser:
   http://localhost/EINDPROJECT_ONLINESTORE/Project-root/index.php

---

## 🧠 Zelfreflectie

**Zelfinschatting:** 15 / 20

Alle gevraagde functionaliteiten zijn geïmplementeerd.
De applicatie werkt stabiel lokaal, maakt correct gebruik van OOP,
prepared statements en XSS-bescherming.
Online deployment is geprobeerd maar niet tijdig stabiel afgerond.

---

## 👨‍💻 Auteur

Hamza Tazi  
Backend Development – 2025/2026
