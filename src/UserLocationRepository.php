<?php
namespace Drupal\where_are_my_people;
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
 * 
 */
/**
 * This service gets the location of a user;
 *
 * @author ndavis
 */
 

class UserLocationRepository implements UserLocationRepositoryInterface {
    /* 
     * function getLocation($username)
     * @returns array containing location data
     */
    public function getLocation($username)
    {
        $user =  user_load_by_name($username);
        return [
            'longitude' => $user->get('field_current_longitude')->value,
            'latitude' => $user->get('field_current_latitude')->value
        ];
    }
    /* 
     * function setLocation($username, $longitude, $latitude)
     * @returns String status message
     * @todo Implement data validation class
     */
    public function setLocation($username, $longitude, $latitude) {
        $user = user_load_by_name($username);      
        if($user && is_float((double)$longitude) && is_float((double)$latitude)){
            $user->set('field_current_longitude', $longitude);
            $user->set('field_current_latitude', $latitude);
            $user->save();
            $message = "Location updated successfully.";
        }
        elseif(!$user){
            $message = "User not found.";
        }
        elseif(!is_float((double)$longitude) || !is_float((double)$latitude)){
            $message = "Location data must be a decimal data type 10, 7 precision";
        }
        $response = ['message' => $message];
        return new ResourceResponse($response);
    }

}

