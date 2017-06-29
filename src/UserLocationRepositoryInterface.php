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
 *
 * @author ndavis
 */
interface UserLocationRepositoryInterface {
    public function getLocation($username);
    public function setLocation($username, $longitude, $latitude);
}
