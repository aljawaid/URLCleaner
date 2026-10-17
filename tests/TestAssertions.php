<?php

/**
 * Provides dependency-free assertions for URLCleaner's focused test suite.
 *
 * Related test files: every *Test.php file in this directory.
 */

function urlCleanerAssertTrue($condition, $message)
{
    if (!$condition) {
        throw new RuntimeException($message);
    }
}

function urlCleanerAssertFalse($condition, $message)
{
    urlCleanerAssertTrue(!$condition, $message);
}

function urlCleanerAssertSame($expected, $actual, $message)
{
    if ($expected !== $actual) {
        throw new RuntimeException(
            $message . ' Expected ' . var_export($expected, true) . ', got ' . var_export($actual, true) . '.'
        );
    }
}

function urlCleanerAssertContains($needle, $haystack, $message)
{
    urlCleanerAssertTrue(strpos($haystack, $needle) !== false, $message);
}

function urlCleanerAssertNotContains($needle, $haystack, $message)
{
    urlCleanerAssertTrue(strpos($haystack, $needle) === false, $message);
}
