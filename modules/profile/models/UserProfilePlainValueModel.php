<?php
//declare(strict_types=1);

namespace app\modules\profile\models;

/**
 * Контейнер для обычных текстовых значений
 */
class UserProfilePlainValueModel implements UserProfileValueInterface
{
    /** @var string */
    private $label;
    /** @var string */
    private $value;

    /**
     * UserProfilePlainValueModel constructor.
     * @param $label
     * @param $value
     */
    public function __construct($label, $value)
    {
        $this->label = (string) $label;
        $this->value = (string) $value;
    }

    /**
     * Возвращает HTML-код для значения label
     * @return string
     */
    public function getLabelHtml(): string
    {
        return $this->label;
    }

    /**
     * Возвращает HTML-код для значения body
     * @return string
     */
    public function getValueHtml(): string
    {
        return $this->value;
    }
}
