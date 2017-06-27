<?php

namespace Drupal\where_are_my_people\Plugin\rest\resource;

use Drupal\rest\Plugin\ResourceBase;
use Drupal\rest\ResourceResponse;
use Drupal\rest\RequestHandler;
use Drupal;
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
    
  //get location GET  
  public function get(String $username) {
    $user = user_load_by_name($username);
      $arrLocation = [
          'longitude' => $user->get('field_current_longitude'),
          'latitude' => $user->get('field_current_latitude'),
      ];
    $response = ['location' => $arrLocation];
    return new ResourceResponse($response);
  }
  
  //set location POST
  public function post(array $data) {
    $user = user_load_by_name($data['username']);
    $user->set('field_current_longitude', $data['long']);
    $user->set('field_current_latitude', $data['lat']);
    $user->save();
    $message = "Location updated successfully.";
    $response = ['message' => $message];
    return new ResourceResponse($response);
  }
}
