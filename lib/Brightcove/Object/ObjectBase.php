<?php

namespace Brightcove\Object;

/**
 * Base object which implements most of a needed methods to satisfy ObjectInterface.
 *
 * @internal
 */
class ObjectBase implements ObjectInterface {
  /**
   * This internal list keeps track of the changed fields.
   *
   * This is necessary bookeeping for patchJSON().
   *
   * @var array
   */
  private $changedFields = [];

  /**
   * Key-value pairs of field aliases. This will be used when the field gets serialized.
   *
   * @var array
   */
  protected $fieldAliases = [];

  /**
   * Marks a field as changed.
   *
   * All property setters should call this function.
   *
   * @param string $field_name
   *
   * @internal
   */
  public function fieldChanged($field_name) {
    $this->changedFields[] = $field_name;
  }

  /**
   * Marks a field or fields unchanged.
   *
   * @param $field_name
   *
   * @internal
   */
  public function fieldUnchanged($field_name) {
    $fields = func_get_args();
    $this->changedFields = array_diff($this->changedFields, $fields);
  }

  /**
   * Resolves the field name alias if there's any.
   *
   * @param string $name
   * @return string
   *
   * @internal
   */
  protected function canonicalFieldName($name) {
    return isset($this->fieldAliases[$name]) ? $this->fieldAliases[$name] : $name;
  }

  /**
   * @return array
   *
   * @internal
   */
  public function postJSON() {
    $data = [];
    foreach ($this as $field => $val) {
      if ($field === 'changedFields' || $field === 'fieldAliases' || $val === NULL) {
        continue;
      }
      $field = $this->canonicalFieldName($field);
      if ($val instanceof ObjectInterface) {
        $data[$field] = $val->postJSON();
      }
      else if (is_array($val)) {
        $data[$field] = [];
        foreach ($val as $k => $v) {
          if ($v instanceof ObjectInterface) {
            $data[$field][$k] = $v->postJSON();
          }
          else {
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
   * @return array
   *
   * @internal
   */
  public function patchJSON() {
    $data = [];
    foreach ($this->changedFields as $field) {
      $val = $this->{$field};
      if ($val === NULL) {
        continue;
      }

      $field = $this->canonicalFieldName($field);

      if ($val instanceof ObjectInterface) {
        $data[$field] = $val->patchJSON();
      } else if (is_array($val)) {
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
   * @param array $json
   *
   * @internal
   */
  public function applyJSON(array $json) {}

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
  protected function applyProperty(array $json, $name, $json_name = NULL, $classname = NULL, $is_array = FALSE) {
    if ($json_name === NULL) {
      $json_name = $name;
    }
    if (!isset($json[$json_name])) {
      return;
    }

    if ($classname === NULL) {
      $this->$name = $json[$json_name];
    }
    else {
      if ($is_array) {
        $arr = [];
        foreach ($json[$json_name] as $k => $v) {
          $class = new $classname();
          $class->applyJSON($v);
          $arr[$k] = $class;
        }
        $this->$name = $arr;
      }
      else {
        $class = new $classname();
        $class->applyJSON($json[$json_name]);
        $this->$name = $class;
      }
    }
  }

  /**
   * @param array|string $json
   *
   * @return static
   *
   * @internal
   */
  public static function fromJSON($json) {
    if (is_string($json)) {
      $json = json_decode($json, TRUE);
    }

    $ret = new static();
    $ret->applyJSON($json);

    return $ret;
  }
}
