<?php

namespace Modules\Common\DTO;

abstract class BaseDTO
{
    private $properties;

    public function __construct(array $data)
    {
        $reflection = new \ReflectionObject($this);
        $this->properties = $reflection->getProperties();

        $this->fillProps($data);
    }

    public function toArray(array $allowedFields = [], bool $except = false)
    {
        $arrayProps = [];

        foreach ($this->properties as $property) {
            if (isset($this->{$property->name})) {
                if ($this->checkAvailableField($allowedFields, $property->name, $except)) {
                    continue;
                }
                $arrayProps[$property->name] = $this->{$property->name};
            }
        }

        return $arrayProps;
    }

    private function fillProps(array $fields)
    {
        foreach ($this->properties as $property) {
            if (isset($fields[$property->name])) {
                $this->{$property->name} = $fields[$property->name];
            }
        }
    }

    private function checkAvailableField(array $allowedFields, string $propName, bool $except): bool
    {
        return count($allowedFields) &&
                ($except ? in_array($propName, $allowedFields) : !in_array($propName, $allowedFields));
    }
}
