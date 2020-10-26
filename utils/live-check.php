<?php

/**
 * Checks to see if the website is running in a live environment.
 * @return {Boolean}
 */
function liveCheck(){
    return !preg_match("/localhost|wpengine/i",get_home_url());
}

?>