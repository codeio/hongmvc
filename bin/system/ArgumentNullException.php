<?php

class ArgumentNullException extends Exception
{
    public function getName()
    {
        return 'Unknown Class';
    }

#region Exception Members

/**
 * Construct the exception
 * Constructs the Exception.
 *
 * @param string $message The Exception message to throw.
 * @param int $code The Exception code.
 * @param Exception $previous The previous exception used for the exception chaining.
 */
function __construct($message = "", $code = 0, $previous = NULL)
{
	parent::__construct($message, $code, $previous);
}

/**
 * Gets the Exception message
 * Returns the Exception message.
 *
 * @return string
 */
function getMessage()
{
	return parent::getMessage();
}

/**
 * Returns previous Exception (the third parameter of Exception::__construct() ).
 *
 * @return Exception
 */
function getPrevious()
{
	return parent::getPrevious();
}

/**
 * Gets the Exception code
 * Returns the Exception code.
 *
 * @return mixed
 */
function getCode()
{
	return parent::getCode();
}

/**
 * Gets the file in which the exception occurred
 * Get the name of the file the exception was created.
 *
 * @return string
 */
function getFile()
{
	return parent::getFile();
}

/**
 * Gets the line in which the exception occurred
 * Get line number where the exception was created.
 *
 * @return int
 */
function getLine()
{
	return parent::getLine();
}

/**
 * Gets the stack trace
 * Returns the Exception stack trace.
 *
 * @return array
 */
function getTrace()
{
	return parent::getTrace();
}

/**
 * Gets the stack trace as a string
 * Returns the Exception stack trace as a string.
 *
 * @return string
 */
function getTraceAsString()
{
	return parent::getTraceAsString();
}

/**
 * String representation of the exception
 * Returns the string representation of the exception.
 *
 * @return string
 */
function __toString()
{
	return parent::__toString();
}

#endregion
}

?>