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
use Symfony\Component\DependencyInjection\ContainerInterface;
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
   *     "canonical" = "/where_they_are/{username}"
   *   }
   */
  protected $repoUserLocation;

  public function __construct(UserLocationRepositoryInterface $repoUserLocation){
      $this->repoUserLocation = $repoUserLocation; 
  }
  /**
   * {@inheritdoc}
   * inject dependencies...
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('where_are_my_people.user_location')
    );
  }

  public function basic() {
    $element = array(
      '#markup' => 'Provide a username at end of url to see map',
    );
    return $element;
  }
  public function showMap($username)
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