<?php

/**
 * @file
 * Definition of Drupal\Core\Ajax\CommandInterface.
 */

namespace renk\yiipal\base\ajax;

/**
 * AJAX command interface.
 *
 * All AJAX commands passed to AjaxResponse objects should implement these
 * methods.
 *
 * @ingroup ajax
 */
interface CommandInterface {

  /**
   * Return an array to be run through json_encode and sent to the client.
   */
  public function render();
}
