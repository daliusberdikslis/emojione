<?php

namespace Emojione;

interface RulesetInterface
{
    /**
     * Returns the shortcode unicode replacement rules
     *
     * @return array The shortcode unicode rules
     */
    public function getShortcodeReplace(): array;

    /**
     * Returns the ascii unicode replacement rules
     *
     * @return array The ascii unicode rules
     */
    public function getAsciiReplace(): array;

    /**
     * Returns the unicode shortcode replacement rules
     *
     * @return array The unicode shortcode rules
     */
    public function getUnicodeReplace(): array;

    /**
     * Returns the unicode shortcode greedy replacement rules
     *
     * @return array The unicode shortcode greedy rules
     */
    public function getUnicodeReplaceGreedy(): array;

    /**
     * Returns the regexp to find ascii smilies
     *
     * @return string The regexp
     */
    public function getAsciiRegexp(): string;
}