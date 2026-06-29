<?php

namespace Brightcove\Item;

use function get_object_vars;

class ObjectBase implements ObjectInterface
{
    protected array $fieldAliases = [];

    /**
     * This is necessary bookkeeping for patchJSON().
     */
    private array $changedFields = [];

    public static function fromJSON(array|string $json): static
    {
        if (is_string($json)) {
            $json = json_decode($json, true);
        }

        $ret = new (static::class)();
        $ret->applyJSON($json);

        return $ret;
    }

    /**
     * All property setters should call this function.
     */
    public function fieldChanged(string $fieldName): void
    {
        $this->changedFields[] = $fieldName;
    }

    public function fieldUnchanged(string $fieldName): void
    {
        $fields = func_get_args();
        $this->changedFields = array_diff($this->changedFields, $fields);
    }

    public function postJSON(): array
    {
        $data = [];
        foreach (get_object_vars($this) as $field => $val) {
            if ($field === 'changedFields' || $field === 'fieldAliases' || $val === null) {
                continue;
            }
            $field = $this->canonicalFieldName($field);
            if ($val instanceof ObjectInterface) {
                $data[$field] = $val->postJSON();
            } elseif (is_array($val)) {
                $data[$field] = [];
                foreach ($val as $k => $v) {
                    if ($v instanceof ObjectInterface) {
                        $data[$field][$k] = $v->postJSON();
                    } else {
                        $data[$field][$k] = $v;
                    }
                }
            } else {
                $data[$field] = $val;
            }
        }
        return $data;
    }

    public function patchJSON(): array
    {
        $data = [];
        foreach ($this->changedFields as $field) {
            $val = $this->{$field};
            if ($val === null) {
                continue;
            }

            $field = $this->canonicalFieldName($field);

            if ($val instanceof ObjectInterface) {
                $data[$field] = $val->patchJSON();
            } elseif (is_array($val)) {
                $data[$field] = [];
                foreach ($val as $k => $v) {
                    if ($v instanceof ObjectInterface) {
                        $data[$field][$k] = $v->patchJSON();
                    } else {
                        $data[$field][$k] = $v;
                    }
                }
            } else {
                $data[$field] = $val;
            }
        }

        $this->changedFields = [];

        return $data;
    }

    public function applyJSON(array $json): void
    {
    }

    protected function canonicalFieldName(string $name): string
    {
        return $this->fieldAliases[$name] ?? $name;
    }

    protected function applyProperty(array $json, string $name, ?string $jsonName = null, ?string $className = null, bool $isArray = false): void
    {
        if ($jsonName === null) {
            $jsonName = $name;
        }
        if (!isset($json[$jsonName])) {
            return;
        }

        if ($className === null) {
            $this->$name = $json[$jsonName];
        } elseif ($isArray) {
            $arr = [];
            foreach ($json[$jsonName] as $k => $v) {
                /** @var ObjectInterface $class */
                $class = new $className();
                $class->applyJSON($v);
                $arr[$k] = $class;
            }
            $this->$name = $arr;
        } else {
            /** @var ObjectInterface $class */
            $class = new $className();
            $class->applyJSON($json[$jsonName]);
            $this->$name = $class;
        }
    }
}
