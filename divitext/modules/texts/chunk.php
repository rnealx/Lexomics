<?php
// diviText is a graphical text segmentation tool for use in text mining.
//     Copyright (C) 2011 Amos Jones and Lexomics Research Group
// 
//     This program is free software: you can redistribute it and/or modify
//     it under the terms of the GNU General Public License as published by
//     the Free Software Foundation, either version 3 of the License, or
//     (at your option) any later version.
// 
//     This program is distributed in the hope that it will be useful,
//     but WITHOUT ANY WARRANTY; without even the implied warranty of
//     MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
//     GNU General Public License for more details.
// 
//     You should have received a copy of the GNU General Public License
//     along with this program.  If not, see <http://www.gnu.org/licenses/>.

$HOME = "../..";

require_once( "$HOME/includes/nav.php" );

require_once( $MODLOGIN );
require_once( $MODTEXTS );
require_once( $MODCHUNKSET );

session_start();
login();

$errors = null;

if ( !isset( $_POST['textid'] ) || !isset( $_POST['spaces'] ) || 
     !isset( $_POST['name'] ) )
{
    $message['success'] = false;
    $errors[] = "Missing POST data.";
    $message['errors'] = $errors;
    echo json_encode( $message );
    trigger_error( "Missing POST data for chunker." );
}

$text = $_SESSION['user']['texts'][$_POST['textid']];

if ( !$text )
{
    $errors[] = "Text could not be found.";
    trigger_error( "Text '{$_POST['textid']}' not found." );
}

$spaces = json_decode( $_POST['spaces'] );

if ( !$spaces )
{
    $errors[] = "No spaces to chunk on or not proper JSON.";
    trigger_error( "No spaces to chunk on or not proper JSON." );
}

    trigger_error( "=" . memory_get_usage() );
$out = $text->chunk( $spaces, $_POST['name'] );

$message = null;
if ( $out )
{
    $message['success'] = false;
    $message['errors'] = $errors;
}
else
{
    $message['success'] = true;
}

echo json_encode( $message );


?>
