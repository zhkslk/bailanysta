# Bailanysta - https://bailanysta.xyz

## Описание проекта
Bailanysta — это платформа социальной сети, где пользователи могут публиковать посты, просматривать ленту постов других пользователей и взаимодействовать через лайки, комментарии и подписку на других пользователей. Приложение реализовано в виде веб-приложения с использованием Laravel, Livewire & TailwindCSS.

## Установка и запуск
Установка может быть затруднительной, поэтому для демо проекта вы можете пройти по адресу https://bailanysta.xyz и посмотреть вживую.

### Требования
- PHP 8.3 и выше
- MySQL 8
- Node.js (версия 20 или выше)
- npm
- Git

### Инструкции по установке
- Установить [Herd](https://herd.laravel.com/)
- Создать базу данных bailanysta в MySQL
- Склонировать проект 
```bash
git clone https://github.com/zhkslk/bailanysta.git
```
- Перейдите в директорию проекта: `cd bailanysta`
- Создайте .env файл: `cp .env.example .env`
- Внутри .env файла для переменных DB_* проставить нужные значения
- `composer install`
- `php artisan key:generate`
- `php artisan migrate`
- `npm install & npm run build`
- Открыть в браузере http://bailanysta.test
