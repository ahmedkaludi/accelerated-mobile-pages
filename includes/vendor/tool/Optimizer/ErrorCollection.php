<?php

namespace AmpProject\Optimizer;

use ArrayIterator;
use Countable;
use IteratorAggregate;

/**
 * Collection of error objects to pass around the transformation engine.
 *
 * @package ampproject/amp-toolbox
 */
final class ErrorCollection implements Countable, IteratorAggregate
{

    /**
     * Internal storage for the errors that were added.
     *
     * @var Error[]
     */
    private $errors = [];

    /**
     * Add an error to the error collection.
     *
     * @param Error $error Error to add.
     * @return void
     */
    public function add(Error $error)
    {
        $this->errors[] = $error;
    }

    /**
     * Check whether the error collection contains an error for the given code.
     *
     * @param string $code Code of the error.
     * @return bool Whether the error collection contains an error with the given code.
     */
    public function has($code)
    {
        foreach ($this->errors as $error) {
            if ($error->getCode() === $code) {
                return true;
            }
        }

        return false;
    }

    /**
     * Get the iterator for iterating over the collection.
     *
     * @return ArrayIterator Iterator for the contained errors.
     */
    public function getIterator()
    {
        return new ArrayIterator($this->errors);
    }

    /**
     * Count how many errors are contained within the error collection.
     *
     * @return int Number of contained errors.
     */
    public function count():int
    {
        return count($this->errors);
    }
}
