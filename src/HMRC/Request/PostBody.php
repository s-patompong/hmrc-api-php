<?php

namespace HMRC\Request;

use HMRC\Exceptions\InvalidPostBodyException;

interface PostBody
{
    /**
     * Validate the post body, it should throw an Exception if something is wrong.
     *
     * @throws InvalidPostBodyException
     */
    public function validate();

    /**
     * Return post body as an array to be used to call.
     *
     * @return array
     */
    public function toArray(): array;
}
