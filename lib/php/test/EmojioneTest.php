<?php

declare(strict_types=1);

namespace Emojione\Test;

require_once '../../../vendor/autoload.php';

use Emojione\Emojione;
use PHPUnit\Framework\TestCase;
use RuntimeException;
use JsonException;

class EmojioneTest extends TestCase
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

        $data = [];
        foreach ($json as $emoji) {
            if (isset($emoji['ascii']) && is_array($emoji['ascii'])) {
                foreach ($emoji['ascii'] as $ascii) {
                    $data[] = [$ascii, $emoji['shortname']];
                }
            }
        }

        return $data;
    }

    /**
     * test Emojione::toImage()
     *
     * @return void
     */
    public function testToImage(): void
    {
        $test = 'Hello world! 😄 :smile:';
        $expected = 'Hello world! <img class="emojione" alt="😄" title=":smile:" src="https://cdn.jsdelivr.net/emojione/assets/' . $this->emojiVersion . '/png/32/1f604.png"/> <img class="emojione" alt="&#x1f604;" title=":smile:" src="https://cdn.jsdelivr.net/emojione/assets/' . $this->emojiVersion . '/png/32/1f604.png"/>';

        $this->assertEquals($expected, Emojione::toImage($test));
    }

    /**
     * test Emojione::unifyUnicode()
     *
     * @return void
     */
    public function testUnifyUnicode(): void
    {
        $test = 'Hello world! 😄 :smile:';
        $expected = 'Hello world! 😄 😄';

        $this->assertEquals($expected, Emojione::unifyUnicode($test));
    }

    /**
     * test Emojione::shortnameToUnicode()
     *
     * @return void
     */
    public function testShortnameToUnicode(): void
    {
        $test = 'Hello world! 😄 :smile:';
        $expected = 'Hello world! 😄 😄';

        $this->assertEquals($expected, Emojione::shortnameToUnicode($test));
    }


    /**
     * test Emojione::shortnameToAscii()
     *
     * @return void
     */
    public function testShortnameToAscii(): void
    {
        $test = 'Hello world! 🙂 :slight_smile:';
        $expected = 'Hello world! 🙂 :]';

        $this->assertEquals($expected, Emojione::shortnameToAscii($test));
    }

    /**
     * test Emojione::shortnameToImage()
     *
     * @return void
     */
    public function testShortnameToImage(): void
    {
        $test = 'Hello world! 😄 :smile:';
        $expected = 'Hello world! 😄 <img class="emojione" alt="&#x1f604;" title=":smile:" src="https://cdn.jsdelivr.net/emojione/assets/' . $this->emojiVersion . '/png/32/1f604.png"/>';

        $this->assertEquals($expected, Emojione::shortnameToImage($test));
    }

    /**
     * test Emojione::toShort()
     *
     * @return void
     */
    public function testToShort(): void
    {
        $test = 'Hello world! 😄 :smile:';
        $expected = 'Hello world! :smile: :smile:';

        $this->assertEquals($expected, Emojione::toShort($test));
    }

    /**
     *
     * test Emojione::asciiToShortname()
     *
     * @return void
     */
    public function testAsciiToShortname(): void
    {
        $test = 'Hello world! :) :D ;) :smile:';
        $expected = 'Hello world! :slight_smile: :smiley: :wink: :smile:';

        // enable ASCII conversion
        $default_ascii = Emojione::$ascii;
        Emojione::$ascii = true;

        $this->assertEquals($expected, Emojione::asciiToShortname($test));

        // back to default ASCII conversion
        Emojione::$ascii = $default_ascii;
    }

    /**
     * Test Ascii to shortnames with dataProvider
     *
     * @dataProvider emojiProvider
     * @param $ascii
     * @param $shortname
     */
    public function testAsciiToShortnameWithDataProvider($ascii, $shortname): void
    {
        $this->assertEquals($shortname, Emojione::asciiToShortname($ascii));
    }

    /**
     * test Emojione::unicodeToImage()
     *
     * @return void
     */
    public function testUnicodeToImage(): void
    {
        $test = 'Hello world! 😄 :smile:';
        $expected = 'Hello world! <img class="emojione" alt="😄" title=":smile:" src="https://cdn.jsdelivr.net/emojione/assets/' . $this->emojiVersion . '/png/32/1f604.png"/> :smile:';

        $this->assertEquals($expected, Emojione::unicodeToImage($test));
    }
}
