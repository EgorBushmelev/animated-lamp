<?php

class users{
    static private function get_user_id(){
        $session =JFactory::getSession();
        $user=$session->get('parususer');
        return $user['id'];
    }

    static function get_ym($uid = null){
        if (!$uid)
            $uid = users::get_user_id();
        //передаем uid в параметрах чтобы избежать повторного запроса
        $db = JFactory::getDBO();
        $query = "SELECT * FROM jos_parususersym WHERE uid = '$uid'";
        //полагаю что uid в таблице - str, если нет, то надо убрать кавычки
        $db->setQuery($query);
        $db->query();
        $result = $db->loadAssoc();
        if(count($result))
            return $result['wallet'];
        //echo 'Ничего не найдено';
        return false;
    }

    static function set_ym($wallet){
        $uid = users::get_user_id();
        if(!users::get_ym($uid)){
            $db = JFactory::getDBO();
            $query = "INSERT INTO jos_parususersym (uid, wallet) VALUES ('$uid', '$wallet')";
            $db->setQuery($query);
            return $db->query() ? true : false;
        }
        //если запись уже была, возвращаем ложь
        return false;
    }
}


class ajax_users{
    static private function validate_ym($wallet){
        if(preg_match('[0-9]{13,}', $wallet))
            return true;
            //проверяем корректность номера кошелька - 13 и более цифр
        else return false;
    }

    static function get_ym(){
        if($wallet = users::get_ym())
            print $wallet;
        else
            print 'undefined';
            //возвращаем undefined, чтобы js понял
        exit;
    }

    static function set_ym(){
        $wallet = trim($_POST['ym']);
        if(ajax_users::validate_ym($wallet)){
            print users::set_ym($wallet) ? 'true' : 'false';
        }
        else print 'false';
        exit;
    }
}
