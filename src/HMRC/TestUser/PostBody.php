<?php

namespace HMRC\TestUser;

use HMRC\Exceptions\InvalidPostBodyException;

class PostBody implements \HMRC\Request\PostBody
{
    /** @var array */
    private $serviceNames;

    /**
     * Validate the post body, it should throw an Exception if something is wrong.
     *
     * @throws InvalidPostBodyException
     */
    public function validate()
    {
        $requiredFields = [
            'serviceNames',
        ];

        $emptyFields = [];
        foreach ($requiredFields as $requiredField) {
            if (is_null($this->{$requiredField})) {
                $emptyFields[] = $requiredField;
            }
        }

        if (count($emptyFields) > 0) {
            $emptyFieldsString = implode(', ', $emptyFields);

            throw new InvalidPostBodyException("Missing post body fields ({$emptyFieldsString}).");
        }
    }

    /**
     * Return post body as an array to be used to call.
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'serviceNames'                 => $this->serviceNames,
        ];
    }

    /**
     * @param array $serviceNames
     *
     * @return $this
     */
    public function setServiceNames(array $serviceNames): self
    {
        $this->serviceNames = $serviceNames;

        return $this;
    }
}
