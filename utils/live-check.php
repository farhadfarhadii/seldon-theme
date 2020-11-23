<?php

/**
 * Checks to see if the website is running in a live environment.
 * @return {Boolean}
 */
function liveCheck(){
    return !preg_match("/localhost|seldondev/i",get_home_url());
}

?>