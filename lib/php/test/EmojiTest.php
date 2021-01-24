<?php

declare(strict_types=1);

namespace Emojione\Test;

require_once '../../../vendor/autoload.php';

use Emojione\Emojione;
use Emojione\Ruleset;

use JsonException;
use PHPUnit\Framework\TestCase;
use RuntimeException;

/**
 * Tests all Emojis from emoji.json
 */
class EmojiTest extends TestCase
{
    private string $emojiVersion = '4.5';

    public function emojiProvider(): array
    {
        $file = __DIR__ . '/../../../emoji.json';

        $string = file_get_contents($file);

        try {
            $json = json_decode($string, true, 512, JSON_THROW_ON_ERROR);
        } catch (JsonException $e) {
            throw new RuntimeException($e->getMessage());
        }

        $data = array();

        foreach ($json as $emoji) {
            $data[] = [$emoji['shortname'], $emoji['code_points']['output']];
        }

        return $data;
    }

    /**
     * test all Emojis and shortcodes
     *
     * @dataProvider emojiProvider
     *
     * @param $shortname
     * @param $simple_unicode
     * @return void
     */
    public function testEmojis($shortname, $simple_unicode): void
    {
        Emojione::$ruleset = new Ruleset();

        $shortcode_replace = Emojione::$ruleset->getShortcodeReplace();
        $unicode_replace = array_flip(Emojione::$ruleset->getUnicodeReplace());

        $unicode = Emojione::shortnameToUnicode($shortname);

        self::assertNotSame($unicode, $shortname);
        self::assertTrue(isset($shortcode_replace[$shortname]));
        self::assertEqualsCanonicalizing($simple_unicode, $shortcode_replace[$shortname][0]);
        self::assertContainsEquals($unicode, $unicode_replace);
        self::assertEqualsCanonicalizing($unicode, $unicode_replace[$shortname]);

        $convert_unicode = strtolower(Emojione::convert($simple_unicode));

        $image_template = '<img class="emojione" alt="%1$s" title="%2$s" src="https://cdn.jsdelivr.net/emojione/assets/' . $this->emojiVersion . '/png/32/%3$s.png"/>';

        $image = sprintf($image_template, $convert_unicode, $shortname, $simple_unicode);

        self::assertEqualsCanonicalizing($image, Emojione::toImage($shortname));
    }
}
