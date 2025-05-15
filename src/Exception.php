<?php declare(strict_types=1);

/**
 * This file is part of Reymon.
 * Reymon is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
 * Reymon is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 * See the GNU General Public License for more details.
 * If not, see <http://www.gnu.org/licenses/>.
 *
 * @author    Mahdi <mahdi.talaee1379@gmail.com>
 * @copyright 2023-2024 Mahdi <mahdi.talaee1379@gmail.com>
 * @license   https://choosealicense.com/licenses/gpl-3.0/ GPLv3
 */

namespace Reymon;

class Exception extends \Exception
{
    public function __construct(string $message = '', int $code = 0, ?\Throwable $previous = null, ?string $file = null, ?int $line = null)
    {
        $this->file = $file ?: $this->file;
        $this->line = $line ?: $this->line;
        parent::__construct($message, $code, $previous);
    }

    private static function throwable(string $message)
    {
        return new static($message, 0, null, 'Reymon', 1);
    }

    /**
     * Complain about missing extensions.
     *
     * @param string $extensionName Extension name
     */
    public static function extension(string $extensionName): self
    {
        $message = \sprintf('Extension %s required', $extensionName);
        return static::throwable($message);
    }

    /**
     * Complain about undefined method.
     *
     * @param string $className Class name
     * @param string $methodName Method name
     */
    public static function undefinedMethod(string $className, string $methodName): self
    {
        $message = \sprintf('Call to undefined method %s::%s', $className, $methodName);
        return static::throwable($message);
    }

    /**
     * Complain about undefined method.
     *
     */
    public static function systemOs(): self
    {
        $message = 'Unfortunately for now Linux Os required';
        return static::throwable($message);
    }
}
