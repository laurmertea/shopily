<?php

/**
 * Return the specified variable naem as an HTML-formatted header.
 *
 * @param string $var
 * @return string
 */
function formattedDataHeader($var): string
{
    return "<div style='background-color: silver; padding: 0.25em;'><strong>{$var}</strong></div>\n";
}

/**
 * Return an HTML-formatted message with optional data, if provided.
 *
 * @param string $message
 * @param string $additionalData
 * @return string
 */
function formattedMessage($message, $additionalData = null): string
{
    return "<span style='color: white; background-color: red; padding: 0.25em 0.75em;'>{$message} " . (($additionalData) ?? "") . "</span>";
}

/**
 * Dumps & dies the specified data, with the variable name, if selected.
 *
 * @param mixed $data
 * @param bool $withName
 * @return exit
 * 
 * @SuppressWarnings(PHPMD.Superglobals)
 * @SuppressWarnings(PHPMD.ExitExpression)
 * @SuppressWarnings(PHPMD.DevelopmentCodeFragment)
 * @SuppressWarnings(PHPMD.ShortMethodName)
 * @SuppressWarnings(PHPMD.BooleanArgumentFlag)
 */
function dd($data, $withName = true)
{
    if ($withName) {
        foreach($GLOBALS as $name => $value) {
            if ($value === $data) {
                echo nl2br(formattedDataHeader($name));
                break;
            }
        }
    }

    echo "<pre>";
    die(var_dump($data));
    echo "</pre>";
}
