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
use Drupal\where_are_my_people\UserLocationRepository;
use Drupal\where_are_my_people\UserLocationRepositoryInterface;
use Drupal\Core\Controller\ControllerBase;
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
  protected $repoUserLocation;
  
  /*
   * @todo figure out the DIC container and fix this so I don't need to hack my dependency injection by calling a setter from the constructor... 
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('where_are_my_people.user_location')
    );
  }
   * 
   */
  public function __construct(){
        /*
   * @todo Learn Drupal 8's DIC and fix this!
   * This is an ugly hack resulting from my lack of knowledge about Drupal 8's DIC. 
   */
      $this->setRepoUserLocation(new UserLocationRepository());
  }
  /*
   * @todo Learn Drupal 8's DIC and fix this!
   * This is an ugly hack resulting from my lack of knowledge about Drupal 8's DIC. 
   * this function will be dying a horrible death!
   */
  public function setRepoUserLocation(UserLocationRepositoryInterface $repoUserLocation){
      $this->repoUserLocation = $repoUserLocation;   
  }
  public function basic() {
    $element = array(
      '#markup' => 'Provide a username at end of url to see map',
    );
    return $element;
  }
  public function showMap(String $username)
  {
    $arrLocation = $this->repoUserLocation->getLocation($username);
    return [
        '#theme' => 'map_template',
        '#latitude' => $arrLocation['latitude'],
        '#longitude' => $arrLocation['longitude'],
        '#username' => $username
    ];
  }
}