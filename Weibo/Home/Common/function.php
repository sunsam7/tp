<?php
function md10($pwd){
    return md5(substr(md5($pwd), 0,16));
}