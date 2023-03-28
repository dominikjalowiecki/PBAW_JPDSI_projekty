<?php
session_start();
session_destroy();

header('Location: ' . $config->app_url);
