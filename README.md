# Insider Otomatik Mesaj Gönderme Uygulaması

Bu proje, **Laravel 10**, **Redis** ve **MySQL** kullanılarak geliştirilmiştir. Aşağıda projeyi kurmak ve çalıştırmak için gerekli olan adımlar ve komutlar açıklanmıştır.

---

## Gereksinimler

Projenin çalışabilmesi için aşağıdaki yazılımların kurulu olduğundan emin olun:

- PHP 8.1 veya üzeri
- Composer
- MySQL 5.7 veya üzeri
- Redis

---

## Kurulum Adımları

1. **Proje Dosyalarını Kopyalayın:**
   ```bash
   git clone 
   cd 
   composer install
   cp .env.example .env
   php artisan key:generate
    ```
2. **Tabloları ve Verileri Oluşturmak İçin Aşağıdaki Komutu Çalıştırın:**
   ```bash
    php artisan migrate --seed

3. **Bekleyen Mesajları Kuyruğa Atmak İçin:**
   ```bash
    php artisan app:send-messages-to-queue
   
4**Kuyruğu Çalıştırmak İçin:**
   ```bash
    php artisan queue:work
