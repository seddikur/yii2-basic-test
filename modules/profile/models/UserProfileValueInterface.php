<?php
//declare(strict_types=1);

namespace app\modules\profile\models;

/**
 * Общий интерфейс для всех значений информации профиля
 */
interface UserProfileValueInterface
{
    /**
     * Возвращает HTML-код для значения label
     * @return string
     */
    public function getLabelHtml(): string;

    /**
     * Возвращает HTML-код для значения body
     * @return string
     */
    public function getValueHtml(): string;
}
