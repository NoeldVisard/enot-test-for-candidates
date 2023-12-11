Таблицы:
Users

id - PK, serial

email - varchar(255)

password - varchar(128)


Currencies

id - PK, serial

code - varchar(64)

value - real

date - timestamp


Для записи валют буду использовать cron команду: 

0 */3 * * * /usr/bin/php /usr/bin/commands unload/unloadCurrencies >/dev/null 2>&1

Она будет выполняться каждые 3 часа и записывать в бд актуальный курс валют


Так как не используются фреймворки, базовая логика приложения создана в директории core. 