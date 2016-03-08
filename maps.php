<?php


class map {
    static function clean_table(){
        $db = JFactory::getDBO();
        $drop_query = 'DROP TABLE IF EXISTS `map_table`';
        $create_query = 'CREATE TABLE `map_table` (`id` INT NOT NULL AUTO_INCREMENT,'
                      . '`row` VARCHAR(10) NOT NULL, `col` VARCHAR(10), `content` VARCHAR(10000), PRIMARY KEY ( id ))';
        $db->setQuery($drop_query);
        if(!$db->query())
            return false;
        $db->setQuery($create_query);
        return $db->query() ? true : false;
    }


    static function store_cell($row, $col, $data){
        $db = JFactory::getDBO();
        $query = "INSERT INTO TABLE `map_table` (`row`, `col`, `content`) VALUES ('$row', '$col', '$data')";
        $db->setQuery($query);
        return $db->query() ? true : false;
    }

    static function set_cell($row, $col, $data){
        $db = JFactory::getDBO();
        $query = "UPDATE TABLE `map_table` (`row`, `col`, `content`) VALUES ('$row', '$col', '$data')";
        $db->setQuery($query);
        $count = $db->loadResult();
        if ($count == 0){
            $query = "INSERT INTO TABLE `map_table` (`row`, `col`, `content`) VALUES ('$row', '$col', '$data')";
            $db->setQuery($query);
            return $db->query() ? true : false;
        }
        else return true;
    }

    static function get_cell($row, $col){
        $db = JFactory::getDBO();
        $query = "SELECT content FROM map_table WHERE row = '$row' AND col = '$col')";
        $db->setQuery($query);
        return $db->loadResult();
    }

    static function generate_map($width, $height, $rows, $cols){
        $position_x = 0;
        $position_y = 0;
        map::clean_table();
        for ($i = 0; $i < $rows; $i++){
            for ($j = 0; $j < $cols; $j++){
                $id = "r{$i}c{$j}";
                $cell_data = "<div style=\"position:absolute;left:{$position_x};top:{$position_y};"
                           . "width:{$width};height:{$height};\" id=\"{$id}\"></div>";
                map::store_cell($i, $j, $cell_data);
                $position_x += $width;
            }
            $position_x = 0;
            $position_y += $height;
        }
    }
}

class ajaxmap{
    static function get_cell($row, $col){
        print map::get_cell(intval($row), intval($col));
        exit;
    }

    static function set_cell($row, $col, $data){
        print map::set_cell(intval($row), intval($col), mysql_real_escape_string($data)) ? 'true' : 'false';
        exit;
    }
}

