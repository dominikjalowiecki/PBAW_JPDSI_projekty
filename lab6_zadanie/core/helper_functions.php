<?php

namespace core;

function getFromRequest($name)
{
    return isset($_REQUEST[$name]) ? trim($_REQUEST[$name]) : null;
}
