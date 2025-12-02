<?php

declare(strict_types=1);

namespace Brightcove\Item;

/**
 * Base object which implements most of a needed methods to satisfy ObjectInterface.
 *
 * @internal
 */
class ObjectBase implements ObjectInterface
{
    /**
     * Key-value pairs of field aliases. This will be used when the field gets serialized.
     */
    protected array $fieldAliases = [];

    /**
     * This internal list keeps track of the changed fields.
     *
     * This is necessary bookkeeping for patchJSON().
     */
    private array $changedFields = [];

    /**
     * @internal
     */
    public static function fromJSON(array|string $json): static
    {
        if (is_string($json)) {
            $json = json_decode($json, true);
        }

        $ret = new static();
        $ret->applyJSON($json);

        return $ret;
    }

    /**
     * Marks a field as changed.
     *
     * All property setters should call this function.
     *
     * @param string $field_name
     *
     * @internal
     */
    public function fieldChanged(string $field_name): void
    {
        $this->changedFields[] = $field_name;
    }

    /**
     * Marks a field or fields unchanged.
     *
     * @param $field_name
     *
     * @internal
     */
    public function fieldUnchanged($field_name): void
    {
        $fields = func_get_args();
        $this->changedFields = array_diff($this->changedFields, $fields);
    }

    /**
     * @internal
     */
    public function postJSON(): array
    {
        $data = [];
        foreach ($this as $field => $val) {
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

    /**
     * Resolves the field name alias if there's any.
     *
     * @param string $name
     * @return string
     *
     * @internal
     */
    protected function canonicalFieldName($name): string
    {
        return $this->fieldAliases[$name] ?? $name;
    }

    /**
     * @internal
     */
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

    /**
     * Helper method for applyJSON().
     *
     * Applies exactly one property on $this.
     *
     * @param array $json
     *   The full JSON array, decoded as an associative array.
     * @param string $name
     *   The name of the property on $this.
     * @param null|string $json_name
     *   The name of the JSON property. If null, then it is the
     *   same as $name.
     * @param null|string $classname
     *   The type of the property. If null, the JSON data will be
     *   copied as it is. If it's a string, it will be instantiated
     *   as a class, which implements ObjectInterface.
     * @param bool $is_array
     *   If the property is an array. This will be only used
     *   when $classname is not null.
     *
     * @internal
     */
    protected function applyProperty(array $json, $name, $json_name = null, $classname = null, $is_array = false): void
    {
        if ($json_name === null) {
            $json_name = $name;
        }
        if (!isset($json[$json_name])) {
            return;
        }

        if ($classname === null) {
            if (is_string($json[$json_name]) && empty($json[$json_name])) {
                $this->$name = null;
            } else {
                $this->$name = $json[$json_name];
            }
        } elseif ($is_array) {
            $arr = [];
            foreach ($json[$json_name] as $k => $v) {
                $class = new $classname();
                $class->applyJSON($v);
                $arr[$k] = $class;
            }
            $this->$name = $arr;
        } else {
            $class = new $classname();
            $class->applyJSON($json[$json_name]);
            $this->$name = $class;
        }
    }

    /**
     * @param array $json
     *
     * @internal
     */
    public function applyJSON(array $json): void
    {
    }
}
