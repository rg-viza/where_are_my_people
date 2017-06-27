<?php

/*
    Copyright 2017 Neil Paul Davis Jr
   
    This file is part of Where are my people?.

    Where are my people? is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 2 of the License, or
    (at your option) any later version.

    Where are my people? is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with Where are my people?.  If not, see <http://www.gnu.org/licenses/>.
 */
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