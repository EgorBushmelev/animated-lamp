<?php

defined('_JEXEC') or die('Restricted access');

function validate($raw_str){
    return mysql_real_escape_string($raw_str);
};

class autoschools {
    static function add_school($name, $address, $phone, $chiefname, $deputychiefname, $inn, $simulators){
        $v_name = validate($name);
        $v_address = validate($address);
        $v_phone = validate($phone);
        $v_chiefname = validate($chiefname);
        $v_deputychiefname = validate($deputychiefname);
        $v_inn = validate($inn);
        $v_simulators = intval($simulators);
        $db = JFactory::getDBO();
        $query = "INSERT INTO autoschools (name, address, phone, chiefname, deputychiefname, inn, simulators)".
                 "VALUES (\"$v_name\", \"$v_address\", \"$v_phone\", \"$v_chiefname\", \"$v_deputychiefname\", \"$v_inn\", \"$v_simulators\")";
        $db->setQuery($query);
        $db->query();
        if(!$db->query()) {
            echo 'Не удалось записать данные в базу данных';
            return false;
        }
        return true;
    }

    private static function get_field($id, $field){
        $db=JFactory::getDBO();
        $query="SELECT * FROM autoschools WHERE id=$id";
        $db->setQuery($query);
        $db->query();
        $list=$db->loadAssoc();
        if(count($list))
            return $list["$field"];
        echo "Ничего не найдено";
        return null;
    }

    private static function modify_field($id, $field, $value){
        $db = JFactory::getDBO();
        $validated = validate($value);
        $query = "UPDATE autoschools SET $field=\"$validated\" WHERE id=$id";
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
        $validated = intval($value);
        $query = "UPDATE autoschools SET $field=$validated WHERE id=$id";
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

    static function get_name($id){
        return autoschools::get_field($id, 'name');
    }

    static function get_address($id){
        return autoschools::get_field($id, 'address');
    }

    static function get_phone($id){
        return autoschools::get_field($id, 'phone');
    }

    static function get_chiefname($id){
        return autoschools::get_field($id, 'chiefname');
    }

    static function get_deputychiefname($id){
        return autoschools::get_field($id, 'deputychiefname');
    }

    static function get_inn($id){
        return autoschools::get_field($id, 'inn');
    }

    static function get_simulators($id){
        return autoschools::get_field($id, 'simulators');
    }
}

class ajaxautoschools{

    static function get_name(){
        $id = $_POST['get_name'];
        if($id!=null){
            $result = autoschools::get_name($id);
            if($result!=null)
                echo $result;
            else
                echo 'null';
        }
        exit;
    }

    static function get_address(){
        $id = $_POST['get_address'];
        if($id!=null){
            $result = autoschools::get_address($id);
            if($result!=null)
                echo $result;
            else
                echo 'null';
        }
        exit;
    }

    static function get_phone(){
        $id = $_POST['get_phone'];
        if($id!=null){
            $result = autoschools::get_phone($id);
            if($result!=null)
                echo $result;
            else
                echo 'null';
        }
        exit;
    }

    static function get_chiefname(){
        $id = $_POST['get_chiefname'];
        if($id!=null){
            $result = autoschools::get_chiefname($id);
            if($result!=null)
                echo $result;
            else
                echo 'null';
        }
        exit;
    }

    static function get_deputychiefname(){
        $id = $_POST['get_deputychiefname'];
        if($id!=null){
            $result = autoschools::get_deputychiefname($id);
            if($result!=null)
                echo $result;
            else
                echo 'null';
        }
        exit;
    }

    static function get_inn(){
        $id = $_POST['get_inn'];
        if($id!=null){
            $result = autoschools::get_inn($id);
            if($result!=null)
                echo $result;
            else
                echo 'null';
        }
        exit;
    }

    static function get_simulators(){
        $id = $_POST['get_simulators'];
        if($id!=null){
            $result = autoschools::get_simulators($id);
            if($result!=null)
                echo $result;
            else
                echo 'null';
        }
        exit;
    }
}

?>
