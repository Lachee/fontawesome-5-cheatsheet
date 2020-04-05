<?php namespace lachee\fontawesome;
class Icon {
    public const STYLE_LIGHT   = 'light';
    public const STYLE_REGULAR = 'regular';
    public const STYLE_SOLID   = 'solid';
    public const STYLE_DUO     = 'duotone';
    public const STYLE_BRAND   = 'brand';

    /** A free license */
    public const LICENSE_FREE   = 'free';

    /** A pro license */
    public const LICENSE_PRO    = 'pro';

    /** @var string the name of the character */
    public $name;

    /** @var string the unicode codepoint for the character */
    public $unicode;

    /** @var string[string] array of available styles and what license is required */
    public $styles;

    /** Gets the i tag representation of this icon
     * @return string html tag
     */
    public function i($style = self::STYLE_REGULAR) {
        if (!$this->hasStyle($style))
            throw new \Exception("Icon {$this->name} does not have the style {$style}.");

        $class = $this->class($style);
        return "<i class='{$class}'></i>";
    }

    /** Gets the class for a HTML tag.
     * @return string css class
     */
    public function class($style = self::STYLE_REGULAR) {
        if (!$this->hasStyle($style))
            throw new \Exception("Icon {$this->name} does not have the style {$style}.");

        $prefix = self::stylePrefix($style);
        return "{$prefix} fa-{$this->name}";
    }

    /** Checks if the icon has a particular style
     * @param string $style the style to check for
     * @param string $license the license to check for. LICENSE_PRO allows for both free and pro.
     * @return boolean if the style exists
    */
    public function hasStyle($style, $license = self::LICENSE_PRO) {
        if (!isset($this->styles[$style])) return false;
        if ($license == self::LICENSE_FREE && $this->styles[$style] == self::LICENSE_PRO) return false;
        return true;
    }

    /** Gets the prefix of a style */
    public static function stylePrefix($style) {
        switch($style){ 
            default: return '';
            case self::STYLE_LIGHT:     return 'fal';
            case self::STYLE_REGULAR:    return 'far';
            case self::STYLE_SOLID:     return 'fas';
            case self::STYLE_DUO:       return 'fad';
            case self::STYLE_BRAND:     return 'fab';
        }
    }
}