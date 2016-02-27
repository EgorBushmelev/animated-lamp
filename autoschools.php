<?php

defined('_JEXEC') or die('Restricted access');

function validate($raw_str){
    return mysql_real_escape_string($raw_str);
};

class autoschools {
    static function add_school($name, $address, $phone, $chiefname, $deputychiefname, $inn, $simulators){
        $db = JFactory::getDBO();
        $query = "INSERT INTO autoschools (name, address, phone, chiefname, deputychiefname, inn, simulators)".
                 "VALUES (\"$name\", \"$address\", \"$phone\", \"$chiefname\", \"$deputychiefname\", \"$inn\", \"$simulators\")";
        $db->setQuery($query);
        $db->query();
        if(!$db->query()) {
            echo 'Не удалось записать данные в базу данных';
            return false;
        }
        return true;
    }

    private static function modify_field($id, $field, $value){
        $db = JFactory::getDBO();
        $query = "UPDATE autoschools SET $field=\"$value\" WHERE id=$id";
        $db->setQuery($query);
        $db->query();
        if(!$db->query()) {
            echo 'Не удалось модифицировать базу данных';
            return false;
        }
        return true;
    }

    private static function modify_int_field($id, $field, $value){
        $db = JFactory::getDBO();
        $query = "UPDATE autoschools SET $field=$value WHERE id=$id";
        $db->setQuery($query);
        $db->query();
        if(!$db->query()) {
            echo 'Не удалось модифицировать базу данных';
            return false;
        }
        return true;
    }

    static function change_name($id, $new_name){
        return autoschools::modify_field($id, 'name', $new_name);
    }

    static function change_address($id, $new_address){
        return autoschools::modify_field($id, 'address', $new_address);
    }

    static function change_phone($id, $new_phone){
        return autoschools::modify_field($id, 'phone', $new_phone);
    }

    static function change_chiefname($id, $new_chiefname){
        return autoschools::modify_field($id, 'chiefname', $new_chiefname);
    }

    static function change_deputychiefname($id, $new_deputychiefname){
        return autoschools::modify_field($id, 'deputychiefname', $new_deputychiefname);
    }

    static function change_inn($id, $new_inn){
        return autoschools::modify_field($id, 'inn', $new_inn);
    }

    static function change_simulators($id, $new_simulators){
        return autoschools::modify_int_field($id, 'simulators', $new_simulators);
    }
}

?>
