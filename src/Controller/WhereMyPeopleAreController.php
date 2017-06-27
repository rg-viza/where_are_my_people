<?php
namespace Drupal\where_are_my_people\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Entity;
/**
 * Provides route responses for the Example module.
 */
class WhereMyPeopleAreController extends ControllerBase {
  /**
   * Returns a simple page.
   *
   * @return array
   *   A simple renderable array.
   *   uri_paths = {
   *     "canonical" = "/where_my_people_are/{username}"
   *   }
   */
  public function basic() {
    $element = array(
      '#markup' => 'Provide a username at end of url to see map',
    );
    return $element;
  }
  public function showMap(String $username)
  {
    /*
    $element = array(
      '#markup' => "Here is a map for {$username}",
              
    );
     * 
     */
    $user =  user_load_by_name($username);
    return [
        '#theme' => 'map_template',
        '#latitude' => $user->get('field_current_latitude')->value,
        '#longitude' => $user->get('field_current_longitude')->value,
        '#username' => $username
    ];
  }
}