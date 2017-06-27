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

use Drupal\rest\Plugin\ResourceBase;
use Drupal\rest\ResourceResponse;
//use Drupal\rest\RequestHandler;
//use Drupal;
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
    if($user && is_float((double)$data['long']) && is_float((double)$data['lat'])){
        $user->set('field_current_longitude', $data['long']);
        $user->set('field_current_latitude', $data['lat']);
        $user->save();
        $message = "Location updated successfully.";
    }
    elseif(!$user){
        $message = "User not found.";
    }
    elseif(!is_float((double)$data['long']) || !is_float((double)$data['lat'])){
        $message = "Location data is invalid";
    }
    $response = ['message' => $message];
    return new ResourceResponse($response);
  }
}
