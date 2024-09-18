<?php
unset($_SESSION['user']);
redirect('?module=auth&action=login');