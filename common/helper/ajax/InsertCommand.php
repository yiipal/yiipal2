<?php

namespace renk\yiipal\base\ajax;

/**
 * Generic AJAX command for inserting content.
 *
 * This command instructs the client to insert the given HTML using whichever
 * jQuery DOM manipulation method has been specified in the #ajax['method']
 * variable of the element that triggered the request.
 *
 * This command is implemented by Drupal.AjaxCommands.prototype.insert()
 * defined in misc/ajax.js.
 *
 * @ingroup ajax
 */
class InsertCommand implements CommandInterface {



  /**
   * A CSS selector string.
   *
   * If the command is a response to a request from an #ajax form element then
   * this value can be NULL.
   *
   * @var string
   */
  protected $selector;

  /**
   * The content for the matched element(s).
   *
   * Either a render array or an HTML string.
   *
   * @var string|array
   */
  protected $content;

  /**
   * A settings array to be passed to any any attached JavaScript behavior.
   *
   * @var array
   */
  protected $settings;

  public function __construct($selector, $content, array $settings = NULL) {
    $this->selector = $selector;
    $this->content = $content;
    $this->settings = $settings;
  }

  public function render() {

    return array(
      'command' => 'insert',
      'method' => NULL,
      'selector' => $this->selector,
      'data' => $this->content,
      'settings' => $this->settings,
    );
  }

}
