<?php
    header('Content-Type: application/json');
    header("X-Frame-Options: SAMEORIGIN");
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");
    header("Access-Control-Allow-Methods: GET");
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");
    require_once("../app/classes/names.class.php");
    require_once("../app/classes/relay.class.php");
    if (isset($_GET['name'])) {
        $nip05 = new namesNip();
        $display = $nip05->buscaDisplay($_GET['name']);

        if (isset($display) && $display != null) {
            $output['names'][$_GET['name']] = $display['hexkey'];

            if(isset($display['id_user'])) {
                # asociated to a user maybe have relays
                $relays = new Relay();
                $relays = $relays->getRelays($display['id_user'],$display['id']);
     
                if(isset($relays) && count($relays) >= 1) {
                    $cero = "0";
                    $output['relays'][$display['hexkey']] = array();
                    while ($cero < count($relays)) {
                        $output['relays'][$display['hexkey']][] = $relays[$cero]['relay_url'];
                        $cero++;
                    }
                }
            }
            
            printf(json_encode($output,JSON_UNESCAPED_SLASHES));
        }
    }
    else {
        die();
    }


?>