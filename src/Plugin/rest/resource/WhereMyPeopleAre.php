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
namespace Drupal\where_are_my_people\Plugin\rest\resource;
use Drupal\where_are_my_people\UserLocationRepository;
use Drupal\where_are_my_people\UserLocationRepositoryInterface;
use Drupal\rest\Plugin\ResourceBase;
use Drupal\rest\ResourceResponse;
/**
 * Provides a Resource
 *
 * @RestResource(
 *   id = "where_are_my_people",
 *   label = @Translation("Where My People Are"),
 *   uri_paths = {
 *     "canonical" = "/where_are_my_people/{username}",
 *      "create" =  "/where_are_my_people",
 *      "edit" = "/where_are_my_people"
 *   }
 * )
 */

class WhereMyPeopleAre extends ResourceBase {
/**
 *
 * @var Drupal\where_are_my_people\UserLocationRepositoryInterface $repoUserLocation
 */
  protected $repoUserLocation;  
/**
  * Constructs a Drupal\rest\Plugin\ResourceBase object.
  *
  * @param array $configuration
  *   A configuration array containing information about the plugin instance.
  * @param string $plugin_id
  *   The plugin_id for the plugin instance.
  * @param mixed $plugin_definition
  *   The plugin implementation definition.
  * @param array $serializer_formats
  *   The available serialization formats.
  * @param \Psr\Log\LoggerInterface $logger
  *   A logger instance.
  * @param UserLocationRepositoryInterface $repoUserLocation
  *   An instance of UserLocationRepository 
  */
  public function __construct(
    array $configuration,
    $plugin_id,
    $plugin_definition,
    array $serializer_formats,
    \Psr\Log\LoggerInterface $logger
          /*,
     UserLocationRepositoryInterface $repoUserLocation
           */) {
      
    parent::__construct($configuration, $plugin_id, $plugin_definition, $serializer_formats, $logger);
    
  
    
    /*
     * @todo Figure this out later...
     * I don't yet understand Drupal 8's DIC, but I had to use this 
     * ugly hack to get the dependency in using a setter injection. I do plan on fixing this later...
     * at least the type-hinting is working :-p
     */
      //$this->repoUserLocation = $repoUserLocation;
     $this->setRepoUserLocation(new UserLocationRepository());
  }
  
  public function setRepoUserLocation(UserLocationRepositoryInterface $repoUserLocation)
  {
      
  }
 
  /**
   * @todo: fix this static function def so the dependency injection doesn't require an ugly hack
  
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->getParameter('serializer.formats'),
      $container->get('logger.factory')->get('rest'),
      $container->get('where_are_my_people.user_location')
    );
  } */
  //get location GET
  public function get(String $username) {
    $response = ['location' => $this->repoUserLocation->getLocation($username)];
    return new ResourceResponse($response);
  }
  
  //set location POST
  public function post(array $data) {
    $response = ['message' => $this->repoUserLocation->setLocation($data['username'], $data['long'], $data['lat'])];
    return new ResourceResponse($response);
  }
}
