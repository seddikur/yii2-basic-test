<?php
/**
 * Created by PhpStorm.
 * User: Баранов Владимир <phpnt@yandex.ru>
 * Date: 18.08.2018
 * Time: 19:47
 */

namespace app\models;

class Constants
{
    // Статусы пользователя
    const STATUS_BLOCKED = 6;   // заблокирован
    const STATUS_ACTIVE = 1;    // активен
    const STATUS_WAIT = 2;      // ожидает подтверждения

    // Доступы пользователя
    const ACCESS_ALL = 1;       // всем пользователям
    const ACCESS_GUEST = 2;     // гостям
    const ACCESS_USER = 3;      // авторизованным пользователям

    // Статусы документов
    const STATUS_DOC_ACTIVE = 1;    // активен
    const STATUS_DOC_WAIT = 2;      // ожидает подтверждения
    const STATUS_DOC_BLOCKED = 6;   // заблокирован

    // Статусы I18n
    const STATUS_I18N_ALL = 1;      // переводить все
    const STATUS_I18N_NAMES = 2;    // переводить только названия полей
    const STATUS_I18N_BLOCKED = 6;  // запретить перевод

    // Пол пользователя
    const SEX_FEMALE    = 1;
    const SEX_MALE      = 2;

    // Пол пользователя
    const BASKET_BUTTON_FOR_ONE     = 1;
    const BASKET_BUTTON_FOR_MANY    = 2;

    // Возможные валюты
    const CURRENCY_RUB = 'RUB';   // заблокирован
    const CURRENCY_USD = 'USD';    // активен
    const CURRENCY_EUR = 'EUR';      // ожидает подтверждения

    // Время действия токенов
    const EXPIRE = 3600;

    // Расширение сохраняемого файла изобрежния
    // Определение Mime не предусмотрено. Файлы
    // изобрежния в соц. сетях часто без расширения в
    // названиях
    const EXT = '.jpg';

    // Параметры RBAC
    const TYPE_ROLE    = 1;
    const TYPE_PERMISSION = 2;

    // Типы представлений шаблонов
    const TYPE_ITEM = 0;        // элемент
    const TYPE_ITEM_LIST = 1;   // элемент списка
    const TYPE_ITEM_BASKET = 2; // элемент корзины

    // типы поле
    const FIELD_TYPE_INT        = 1; // Целое число +
    const FIELD_TYPE_INT_RANGE  = 2; // Диапазон целых чисел
    const FIELD_TYPE_FLOAT      = 3; // Число с дробью
    const FIELD_TYPE_FLOAT_RANGE = 4; // Диапазон чисел с дробью
    const FIELD_TYPE_STRING     = 5; // Строка
    const FIELD_TYPE_TEXT       = 6; // Текст
    const FIELD_TYPE_CHECKBOX   = 7; // Чекбокс
    const FIELD_TYPE_RADIO      = 8; // Радиокнопка
    const FIELD_TYPE_LIST       = 9; // Список
    const FIELD_TYPE_LIST_MULTY = 10; // Список с мультивыбором
    const FIELD_TYPE_PRICE      = 11; // Телефон
    const FIELD_TYPE_DATE       = 12; // Дата
    const FIELD_TYPE_DATE_RANGE = 13; // Диапазон дат
    const FIELD_TYPE_ADDRESS    = 14; // Адрес
    const FIELD_TYPE_CITY       = 15; // Город
    const FIELD_TYPE_REGION     = 16; // Регион
    const FIELD_TYPE_COUNTRY    = 17; // Страна
    const FIELD_TYPE_EMAIL      = 18; // Эл. почта
    const FIELD_TYPE_URL        = 19; // Ссылка
    const FIELD_TYPE_SOCIAL     = 20; // Страница соц. сети
    const FIELD_TYPE_YOUTUBE    = 21; // Видео YouTube
    const FIELD_TYPE_FILE       = 22; // Файл
    const FIELD_TYPE_FEW_FILES  = 23; // Несколько файлов
    const FIELD_TYPE_DISCOUNT   = 24; // Скидка
    const FIELD_TYPE_DOC        = 25; // Дополнительная связь к другому документу или элементу
    const FIELD_TYPE_NUM        = 26; // Тип поля - номер

    // расширения для файлов
    const FILE_EXT_JPEG         = 'jpeg'; //
    const FILE_EXT_JPG          = 'jpg'; //
    const FILE_EXT_PNG          = 'png'; //
    const FILE_EXT_PSD          = 'psd'; //
    const FILE_EXT_PDF          = 'pdf'; //
    const FILE_EXT_DOC          = 'doc'; //
    const FILE_EXT_DOCX         = 'docx'; //
    const FILE_EXT_XLS          = 'xls'; //
    const FILE_EXT_XLSX         = 'xlsx'; //
    const FILE_EXT_TXT          = 'txt'; //
    const FILE_EXT_MP3          = 'mp3'; //
    const FILE_EXT_WAV          = 'wav'; //
    const FILE_EXT_AVI          = 'avi'; //
    const FILE_EXT_MPG          = 'mpg'; //
    const FILE_EXT_MPEG         = 'mpeg'; //
    const FILE_EXT_MPEG_4       = 'mpeg_4'; //
    const FILE_EXT_DIVX         = 'divx'; //
    const FILE_EXT_DJVU         = 'djvu'; //
    const FILE_EXT_FB2          = 'fb2'; //
    const FILE_EXT_RAR          = 'rar'; //
    const FILE_EXT_ZIP          = 'zip'; //

    // Единицы измерения
    const ITEM_MEASURE_THING = 0;       // шкука
    const ITEM_MEASURE_MM = 1;          // миллиметр
    const ITEM_MEASURE_CM = 2;          // сантиметр
    const ITEM_MEASURE_M = 3;           // метр
    const ITEM_MEASURE_MM2 = 4;         // милиметр кв
    const ITEM_MEASURE_CM2 = 5;         // сантиметр кв
    const ITEM_MEASURE_M2 = 6;          // метр кв
    const ITEM_MEASURE_MG = 7;          // миллиграмм
    const ITEM_MEASURE_G = 8;           // грамм
    const ITEM_MEASURE_KG = 9;          // килограмм
    const ITEM_MEASURE_T = 10;          // тонн
    const ITEM_MEASURE_ML = 11;         // миллилитр
    const ITEM_MEASURE_L = 12;          // литр
    const ITEM_MEASURE_M3 = 13;         // метр куб
}