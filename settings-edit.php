<?php
require_once('includes.php');
//require_once($_SERVER['DOCUMENT_ROOT']."/wp-load.php");
?>

<?php
if (isset($_POST['db-host']) &&
    isset($_POST['db-name']) &&
    isset($_POST['db-user']) &&
    isset($_POST['db-pass']) &&
    isset($_POST['table-select'])){

    if (isset($_POST['menu-title']) &&
        isset($_POST['display-fields']) &&
        isset($_POST['table-id'])) {

        $ini = parse_ini_file("settings.ini",true);
        $options = array();

        $options['dbhost'] = $_POST['db-host'];
        $options['dbname'] = $_POST['db-name'];
        $options['dbuser'] = $_POST['db-user'];
        $options['dbpass'] = $_POST['db-pass'];
        $options['dataTable'] = $_POST['table-select'];
        $options['name'] = $_POST['menu-title'];
        $options['displayColumns'] = $_POST['display-fields'];
        $options['tableId'] = $_POST['table-id'];

        if (isset($_POST['image'])){
            if (isset($_POST['img-url-root']) &&
                isset($_POST['imgsrc'])) {

                $options['image'] = 1;
                $options['imageUrlRoot'] = $_POST['img-url-root'];
                $options['imageSource'] = $_POST['imgsrc'];
            }
            else {
                header("HTTP/1.0 400 Bad Request");
                echo "Missing required image fields";
                exit;
            }
        }
        if (isset($_POST['split'])){
            if (isset($_POST['split-by'])){
                $options['split'] = 1;
                $options['splitBy'] = $_POST['split-by'];
            }
            else {
                header("HTTP/1.0 400 Bad Request");
                echo "Missing required split fields";
                exit;
            }
        }
        if (isset($_POST['order'])){
            if (isset($_POST['order-by'])){
                $options['order'] = 1;
                $options['orderBy'] = $_POST['order-by'];
            }
            else {
                header("HTTP/1.0 400 Bad Request");
                echo "Missing required order fields";
                exit;
            }
        }
        if (isset($_POST['icon'])){
            $options['icon'] = $_POST['icon'];
        }

        $ini[] = $options;
        //print_r($ini);
        write_ini_file("settings.ini", $ini);
        
    }
    else {
        header("HTTP/1.0 400 Bad Request");
        echo "Missing required fields";
    }
}
else {
    header("HTTP/1.0 400 Bad Request");
    echo "Missing database information";
}
?>