<?php

namespace Emojione;

/**
 * Client for Emojione
 */
class Client implements ClientInterface
{
    public bool $ascii = false; // convert ascii smileys?
    public bool $riskyMatchAscii = false; // set true to match ascii without leading/trailing space char
    public bool $shortcodes = true; // convert shortcodes?
    public bool $unicodeAlt = true; // use the unicode char as the alt attribute (makes copy and pasting the resulting text better)
    public string $emojiVersion = '4.5';
    public string $emojiSize = '32'; //available sizes are '32', '64', and '128'
    public bool $sprites = false;
    public string $spriteSize = '32'; // available sizes are '32' and '64'
    public string $imagePathPNG = 'https://cdn.jsdelivr.net/emojione/assets';
    public string $fileExtension = '.png';
    public bool $imageTitleTag = true;
    public string $ignoredRegexp = '<object[^>]*>.*?<\/object>|<span[^>]*>.*?<\/span>|<(?:object|embed|svg|img|div|span|p|a)[^>]*>';
    public string $unicodeRegexp = '(?:[\x{1F3F3}|\x{1F3F4}]\x{FE0F}?\x{200D}?[\x{1F308}|\x{2620}]\x{FE0F}?)|(?:\x{1F441}\x{FE0F}?\x{200D}?\x{1F5E8}\x{FE0F}?)|(?:[\x{1f468}|\x{1f469}]\x{200d}\x{2764}\x{fe0f}?\x{200d}[\x{1f48b}\x{200d}]*[\x{1f468}|\x{1f469}])|(?:[\x{1f468}|\x{1f469}]\x{200d}[\x{1f468}|\x{1f469}]\x{200d}[\x{1f466}|\x{1f467}]\x{200d}[\x{1f466}|\x{1f467}])|(?:[\x{1f468}|\x{1f469}]\x{200d}[\x{1f466}|\x{1f467}]\x{200d}[\x{1f466}|\x{1f467}])|(?:[\x{1f468}|\x{1f469}]\x{200d}[\x{1f468}|\x{1f469}]\x{200d}[\x{1f466}|\x{1f467}])|(?:[\x{1f468}|\x{1f469}]\x{200d}[\x{1f466}|\x{1f467}])|(?:[\x{1F9B8}|\x{1F9B9}]+[\x{1F3FB}-\x{1F3FF}]?\x{200D}[\x{2640}-\x{2642}]?\x{FE0F}?)|(?:[\x{1F468}|\x{1F469}]+[\x{1F3FB}-\x{1F3FF}]?\x{200D}[\x{1F9B0}-\x{1F9B3}]+\x{FE0F}?)|[\x{0023}-\x{0039}]\x{FE0F}?\x{20e3}|(?:\x{1F3F4}[\x{E0060}-\x{E00FF}]{1,6})|[\x{1F1E0}-\x{1F1FF}]{2}|(?:[\x{1F468}|\x{1F469}]\x{FE0F}?[\x{1F3FB}-\x{1F3FF}]?\x{200D}?[\x{2695}|\x{2696}|\x{2708}|\x{1F4BB}|\x{1F4BC}|\x{1F527}|\x{1F52C}|\x{1F680}|\x{1F692}|\x{1F33E}|\x{1F3EB}|\x{1F3EC}|\x{1f373}|\x{1f393}|\x{1f3a4}|\x{1f3ed}|\x{1f3a8}]\x{FE0F}?)|[\x{1F468}-\x{1F469}\x{1F9D0}-\x{1F9DF}][\x{1F3FA}-\x{1F3FF}]?\x{200D}?[\x{2640}\x{2642}\x{2695}\x{2696}\x{2708}]?\x{FE0F}?|(?:[\x{1F9B5}|\x{1F9B6}]+[\x{1F3FB}-\x{1F3FF}]+)|(?:[\x{1f46e}\x{1F468}\x{1F469}\x{1f575}\x{1f471}-\x{1f487}\x{1F645}-\x{1F64E}\x{1F926}\x{1F937}]|[\x{1F460}-\x{1F482}\x{1F3C3}-\x{1F3CC}\x{26F9}\x{1F486}\x{1F487}\x{1F6A3}-\x{1F6B6}\x{1F938}-\x{1F93E}]|\x{1F46F})\x{FE0F}?[\x{1F3FA}-\x{1F3FF}]?\x{200D}?[\x{2640}\x{2642}]?\x{FE0F}?|(?:[\x{26F9}\x{261D}\x{270A}-\x{270D}\x{1F385}-\x{1F3CC}\x{1F442}-\x{1F4AA}\x{1F574}-\x{1F596}\x{1F645}-\x{1F64F}\x{1F6A3}-\x{1F6CC}\x{1F918}-\x{1F93E}]\x{FE0F}?[\x{1F3FA}-\x{1F3FF}])|(?:[\x{2194}-\x{2199}\x{21a9}-\x{21aa}]\x{FE0F}?|[\x{0023}-\x{002a}]|[\x{3030}\x{303d}]\x{FE0F}?|(?:[\x{1F170}-\x{1F171}]|[\x{1F17E}-\x{1F17F}]|\x{1F18E}|[\x{1F191}-\x{1F19A}]|[\x{1F1E6}-\x{1F1FF}])\x{FE0F}?|\x{24c2}\x{FE0F}?|[\x{3297}\x{3299}]\x{FE0F}?|(?:[\x{1F201}-\x{1F202}]|\x{1F21A}|\x{1F22F}|[\x{1F232}-\x{1F23A}]|[\x{1F250}-\x{1F251}])\x{FE0F}?|[\x{203c}\x{2049}]\x{FE0F}?|[\x{25aa}-\x{25ab}\x{25b6}\x{25c0}\x{25fb}-\x{25fe}]\x{FE0F}?|[\x{00a9}\x{00ae}]\x{FE0F}?|[\x{2122}\x{2139}]\x{FE0F}?|\x{1F004}\x{FE0F}?|[\x{2b05}-\x{2b07}\x{2b1b}-\x{2b1c}\x{2b50}\x{2b55}]\x{FE0F}?|[\x{231a}-\x{231b}\x{2328}\x{23cf}\x{23e9}-\x{23f3}\x{23f8}-\x{23fa}]\x{FE0F}?|\x{1F0CF}|[\x{2934}\x{2935}]\x{FE0F}?)|[\x{2700}-\x{27bf}]\x{FE0F}?|[\x{1F000}-\x{1F6FF}\x{1F900}-\x{1F9FF}]\x{FE0F}?|[\x{2600}-\x{26ff}]\x{FE0F}?|(?:[\x{1F466}-\x{1F469}]+\x{FE0F}?[\x{1F3FB}-\x{1F3FF}]?)|[\x{0030}-\x{0039}]\x{FE0F}';
    public string $shortcodeRegexp = ':([-+\\w]+):';

    protected RulesetInterface $ruleset;

    public function __construct(RulesetInterface $ruleset)
    {
        $this->ruleset = $ruleset instanceof RulesetInterface ? $ruleset : new Ruleset();
        $this->imagePathPNG .= '/' . $this->emojiVersion . '/png/' . $this->emojiSize . '/';
        $this->spriteSize = ($this->spriteSize === '32' || $this->spriteSize === '64') ? $this->spriteSize : '32';
    }

    // ##########################################
    // ######## core methods
    // ##########################################

    /**
     * First pass changes unicode characters into emoji shortnames.
     * Second pass changes shortnames into emoji markup.
     *
     * @param string $string The input string.
     * @return  string  String with appropriate html for rendering emoji.
     */
    public function toImage(string $string): string
    {
        $string = $this->unicodeToImage($string);
        $string = $this->shortnameToImage($this->toShort($string));

        return $string;
    }

    /**
     * Uses toShort to transform all unicode into a standard shortname
     * then transforms the shortname into unicode.
     * This is done for standardization when converting several unicode types.
     *
     * @param string $string The input string.
     * @return  string  String with standardized unicode.
     */
    public function unifyUnicode(string $string): string
    {
        $string = $this->toShort($string);
        $string = $this->shortnameToUnicode($string);

        return $string;
    }

    /**
     * This will output unicode from shortname input.
     * If Client/$ascii is true it will also output unicode from ascii.
     * This is useful for sending emojis back to mobile devices.
     *
     * @param string $string The input string.
     * @return  string  String with unicode replacements.
     */
    public function shortnameToUnicode(string $string): string
    {
        if ($this->shortcodes) {
            $string = preg_replace_callback(
                '/' . $this->ignoredRegexp . '|(' . $this->shortcodeRegexp . ')/Si',
                [$this, 'shortnameToUnicodeCallback'],
                $string
            );

            $string = html_entity_decode($string, ENT_COMPAT, 'UTF-8');
        }

        if ($this->ascii) {
            $asciiRegexp = $this->ruleset->getAsciiRegexp();
            $asciiRX = ($this->riskyMatchAscii) ? '|(()' . $asciiRegexp . '())' : '|((\\s|^)' . $asciiRegexp . '(?=\\s|$|[!,.?]))';

            $string = preg_replace_callback(
                '/' . $this->ignoredRegexp . $asciiRX . '/S',
                [$this, 'asciiToUnicodeCallback'],
                $string
            );
        }

        return $string;
    }

    /**
     * This will replace shortnames with their ascii equivalent.
     * ex. :wink: --> ;^)
     * This is useful for systems that don't support unicode or images.
     *
     * @param string $string The input string.
     * @return  string  String with ascii replacements.
     */
    public function shortnameToAscii(string $string): string
    {
        $string = preg_replace_callback(
            '/' . $this->ignoredRegexp . '|(' . $this->shortcodeRegexp . ')/Si',
            [$this, 'shortnameToAsciiCallback'],
            $string
        );

        return $string;
    }

    /**
     * This will replace ascii with their shortname equivalent, it bases on reversed ::shortnameToAsciiCallback
     * ex. :) --> :slight_smile:
     * This is useful for systems that don't ascii emoji.
     *
     * @param string $string The input ascii.
     * @return  string  String with shortname replacements.
     */
    public function asciiToShortname(string $string): string
    {
        $asciiRegexp = $this->ruleset->getAsciiRegexp();
        $asciiRX = ($this->riskyMatchAscii) ? '|(()' . $asciiRegexp . '())' : '|((\\s|^)' . $asciiRegexp . '(?=\\s|$|[!,.?]))';

        return preg_replace_callback(
            '/' . $this->ignoredRegexp . $asciiRX . '/S',
            [$this, 'asciiToShortnameCallback'],
            $string
        );
    }

    /**
     * This will output image markup from shortname input.
     *
     * @param string $string The input string.
     * @return  string  String with appropriate html for rendering emoji.
     */
    public function shortnameToImage(string $string): string
    {
        if ($this->shortcodes) {
            $string = preg_replace_callback(
                '/' . $this->ignoredRegexp . '|(' . $this->shortcodeRegexp . ')/Si',
                [$this, 'shortnameToImageCallback'],
                $string
            );
        }

        if ($this->ascii) {
            $asciiRegexp = $this->ruleset->getAsciiRegexp();
            $asciiRX = ($this->riskyMatchAscii) ? '|(()' . $asciiRegexp . '())' : '|((\\s|^)' . $asciiRegexp . '(?=\\s|$|[!,.?]))';

            $string = preg_replace_callback(
                '/' . $this->ignoredRegexp . $asciiRX . '/S',
                [$this, 'asciiToImageCallback'],
                $string
            );
        }

        return $string;
    }

    /**
     * This will return the shortname from unicode input.
     *
     * @param string $string The input string.
     * @return  string  shortname
     */
    public function toShort(string $string): string
    {
        return preg_replace_callback(
            '/' . $this->ignoredRegexp . '|' . $this->unicodeRegexp . '/u',
            [$this, 'toShortCallback'],
            $string
        );
    }

    /**
     * This method has been deprecated as of 4.0
     *
     * @param string $string The input string.
     * @return  string  returns input string.
     */
    public function unicodeToImage(string $string): string
    {
        if ($this->shortcodes) {
            $string = preg_replace_callback(
                '/' . $this->ignoredRegexp . '|' . $this->unicodeRegexp . '/u',
                [$this, 'unicodeToImageCallback'],
                $string
            );
        }

        return $string;
    }

    // ##########################################
    // ######## preg_replace callbacks
    // ##########################################

    /**
     * @param array $m Results of preg_replace_callback().
     * @return  string  Ascii replacement result.
     */
    public function shortnameToAsciiCallback(array $m): string
    {
        if ((!is_array($m)) || (!isset($m[1])) || (empty($m[1]))) {
            return $m[0];
        }

        $shortcode_replace = $this->ruleset->getShortcodeReplace();
        $ascii_replace = $this->ruleset->getAsciiReplace();

        $aflipped = array_flip($ascii_replace);

        $shortname = $m[0];

        if (!isset($shortcode_replace[$shortname])) {
            return $m[0];
        }

        return $aflipped[$shortname] ?? $m[0];
    }

    /**
     * @param array $m Results of preg_replace_callback().
     * @return  string  Unicode replacement result.
     */
    public function shortnameToUnicodeCallback(array $m): string
    {
        if ((!is_array($m)) || (!isset($m[1])) || (empty($m[1]))) {
            return $m[0];
        }

        $shortcode_replace = $this->ruleset->getShortcodeReplace();
        $shortname = strtolower($m[1]);

        if (!array_key_exists($shortname, $shortcode_replace)) {
            return $m[0];
        }

        $unicode = $shortcode_replace[$shortname][0];

        return $this->convert($unicode);
    }

    /**
     * @param array $m Results of preg_replace_callback().
     * @param string $string_original
     * @return  string  Image HTML replacement result.
     */
    public function shortnameToImageCallback(array $m, string $string_original = ''): string
    {
        if ((!is_array($m)) || (!isset($m[1])) || (empty($m[1]))) {
            return $m[0];
        }

        $shortcode_replace = $this->ruleset->getShortcodeReplace();
        $shortname = $m[1];

        if (!isset($shortcode_replace[$shortname])) {
            return $m[0];
        }

        $unicode = $shortcode_replace[$shortname][0];
        $filename = $shortcode_replace[$shortname][2];
        $category = (strpos($filename, '-1f3f') !== false) ? 'diversity' : $shortcode_replace[$shortname][3];
        $titleTag = $this->imageTitleTag ? 'title="' . htmlspecialchars($shortname) . '"' : '';

        if ($this->unicodeAlt) {
            $alt = $this->convert($unicode);
        } else {
            $alt = $shortname;
        }

        if ($this->sprites) {
            return '<span class="emojione emojione-' . $this->spriteSize . '-' . $category . ' _' . $filename . '" ' . $titleTag . '>' . $alt . '</span>';
        }

        return '<img class="emojione" alt="' . $alt . '" ' . $titleTag . ' src="' . $this->imagePathPNG . $filename . $this->fileExtension . '"/>';
    }

    /**
     * @param array $m Results of preg_replace_callback().
     * @return  string  Image HTML replacement result.
     */
    public function unicodeToImageCallback(array $m): string
    {
        if ((!is_array($m)) || (!isset($m[0])) || (empty($m[0]))) {
            return $m[0];
        }

        $unicode_replace = $this->ruleset->getUnicodeReplace();
        $shortcode_replace = $this->ruleset->getShortcodeReplace();

        $unicode = $m[0];

        if (!array_key_exists($unicode, $unicode_replace)) {
            return $m[0];
        }

        $shortname = $unicode_replace[$unicode];

        if (!isset($shortcode_replace[$shortname])) {
            return $m[0];
        }

        $unicode = $shortcode_replace[$shortname][0];
        $filename = $shortcode_replace[$shortname][2];
        $category = (strpos($filename, '-1f3f') !== false) ? 'diversity' : $shortcode_replace[$shortname][3];
        $titleTag = $this->imageTitleTag ? 'title="' . htmlspecialchars($shortname) . '"' : '';

        if ($this->unicodeAlt) {
            $alt = $this->convert($unicode);

            $alt = html_entity_decode($alt, ENT_COMPAT, 'UTF-8');
        } else {
            $alt = $shortname;
        }

        if ($this->sprites) {
            return '<span class="emojione emojione-' . $this->spriteSize . '-' . $category . ' _' . $filename . '" ' . $titleTag . '>' . $alt . '</span>';
        }

        return '<img class="emojione" alt="' . $alt . '" ' . $titleTag . ' src="' . $this->imagePathPNG . $filename . $this->fileExtension . '"/>';
    }

    /**
     * @param array $m Results of preg_replace_callback().
     * @return  string  Unicode replacement result.
     */
    public function asciiToUnicodeCallback(array $m): string
    {
        if ((!is_array($m)) || (!isset($m[3])) || (empty($m[3]))) {
            return $m[0];
        }

        $ascii_replace = $this->ruleset->getAsciiReplace();
        $shortcode_replace = $this->ruleset->getShortcodeReplace();
        $ascii = $m[3];

        if (empty($ascii_replace[$ascii])) {
            return $m[3];
        }

        $shortname = $ascii_replace[$ascii];
        $uc_output = $shortcode_replace[$shortname][0];

        return $m[2] . $this->convert($uc_output);
    }

    /**
     * @param array $m Results of preg_replace_callback().
     * @return  string  Shortname replacement result.
     */
    public function asciiToShortnameCallback(array $m): string
    {
        if ((!is_array($m)) || (!isset($m[3])) || (empty($m[3]))) {
            return $m[0];
        }

        $ascii_replace = $this->ruleset->getAsciiReplace();
        $shortname = $m[3];

        if (empty($ascii_replace[$shortname])) {
            return $m[3];
        }

        return $m[2] . $ascii_replace[$shortname];
    }

    /**
     * @param array $m Results of preg_replace_callback().
     * @return  string  Image HTML replacement result.
     */
    public function asciiToImageCallback(array $m): string
    {
        if ((!is_array($m)) || (!isset($m[3])) || (empty($m[3]))) {
            return $m[0];
        }

        $ascii_replace = $this->ruleset->getAsciiReplace();
        $shortcode_replace = $this->ruleset->getShortcodeReplace();
        $ascii = html_entity_decode($m[3]);

        if (empty($ascii_replace[$ascii])) {
            return $m[3];
        }

        $shortname = $ascii_replace[$ascii];
        $filename = $shortcode_replace[$shortname][2];
        $uc_output = $shortcode_replace[$shortname][0];
        $category = (strpos($filename, '-1f3f') !== false) ? 'diversity' : $shortcode_replace[$shortname][3];
        $titleTag = $this->imageTitleTag ? 'title="' . htmlspecialchars($shortname) . '"' : '';

        // unicode char or shortname for the alt tag? (unicode is better for copying and pasting the resulting text)
        if ($this->unicodeAlt) {
            $alt = $this->convert($uc_output);
        } else {
            $alt = htmlspecialchars($ascii);
        }

        if ($this->sprites) {
            return $m[2] . '<span class="emojione emojione-' . $this->spriteSize . '-' . $category . ' _' . $filename . '" ' . $titleTag . '>' . $alt . '</span>';
        }

        return $m[2] . '<img class="emojione" alt="' . $alt . '" ' . $titleTag . ' src="' . $this->imagePathPNG . $filename . $this->fileExtension . '"/>';
    }

    /**
     * @param array $m Results of preg_replace_callback().
     * @return  string  shortname result
     */
    public function toShortCallback(array $m): string
    {
        if ((!is_array($m)) || (!isset($m[0])) || (empty($m[0]))) {
            return $m[0];
        }

        $unicode_replace = $this->ruleset->getUnicodeReplace();

        $unicode = $m[0];

        if (!array_key_exists($unicode, $unicode_replace)) {
            return $m[0];
        }

        return $unicode_replace[$unicode];
    }

// ##########################################
// ######## helper methods
// ##########################################

    /**
     * Converts from unicode to hexadecimal NCR.
     *
     * @param string $unicode unicode character/s
     * @return  string  hexadecimal NCR
     */
    public
    function convert(string $unicode): string
    {
        if (strpos($unicode, '-') !== false) {
            $pairs = explode('-', $unicode);

            return '&#x' . implode(';&#x', $pairs) . ';';
        }

        return '&#x' . $unicode . ';';
    }
}