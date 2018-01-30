<?php

namespace Brightcove\Object;

/**
 * Interface ObjectInterface
 *
 * All communication between the wrapper and the API endpoints
 * must use classes that implements ObjectInterface.
 *
 * @internal
 */
interface ObjectInterface {
  /**
   * Creates an associative array from the class properties and values.
   *
   * @return array
   *
   * @internal
   */
  public function postJSON();

  /**
   * Creates an associative array from the changed class properties and values.
   *
   * This associative array contains the properties that have changed since the
   * last call of patchJSON() or the creation of the class.
   *
   * @return array
   *
   * @internal
   */
  public function patchJSON();

  /**
   * Applies a JSON associative array on this class overwriting the values of the properties.
   *
   * @param array $json
   *
   * @internal
   */
  public function applyJSON(array $json);

  /**
   * Creates an instance of the class, prefilled with values from $json.
   *
   * @param string|array $json
   * @return $this
   *
   * @internal
   */
  public static function fromJSON($json);
}