<?php

use StubsGenerator\Finder;

return Finder::create()
    ->in(array(
        'source/vendor/woocommerce/action-scheduler',
    ))
    ->sortByName(true)
;
