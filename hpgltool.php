<?php
/*
 * HPGL tools and stuff optimized for inkscape output 
 * Copyright © 2018 tyrolyean
 * 
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

// Those are defined as variables even though they might no change.
$HPGL_COMMAND_SPLIT = ';';
$HPGL_PARAM_SPLIT = ',';

// There might no be need to increase the memory limit, but there were some
// issues with that and i don't want to risk breaking files
ini_set('memory_limit','100M');


// This parses HPGL files in a more computable format. If you want to
// understand it, it's a 3 dimensional array:
//      1st dimension:  the comand number (in order of execution)
//      2nd dimension:  a array with 2 values (0: command name, 1: values)
//      3rd dimension:  values 
function parse_hpgl($raw_input){
        
        global $HPGL_COMMAND_SPLIT;
        global $HPGL_PARAM_SPLIT; 
        
        $output=[];

        foreach (explode($HPGL_COMMAND_SPLIT,$raw_input) as $command_line) {
                
                if($command_line == "\n" OR $command_line == ""){
                        continue;
                }
                
                $params = explode($HPGL_PARAM_SPLIT,substr($command_line,2));
                $command = [];
                // $cmd = substr($raw_input,0,2);
                
                $command[]=substr($command_line,0,2);

                $command[] = $params;
                for ($i = 0; $i < count($command[1]); $i++) {
                        $command[1][$i] = intval($command[1][$i]);
                }
                
                // The first two chars define the command, everything else are
                // parameters delimited by a ','

                $output[] = $command;
        }

        return $output;
}

// Scales a hpgl array by a given factor
function scale_hpgl($hpgl, $factor){

        for ($i = 0; $i < count($hpgl); $i++) {
                
                if(($hpgl[$i][0] === "PU") OR ($hpgl[$i][0] === "PD")){
                        // The command is a pen up or pen down command and only
                        // those can be actually scaled
                        for($ii = 0; $ii < count($hpgl[$i][1]); $ii++){
                                // HPGL would support decimal numbers, but we
                                // don't know if our plotter does and we don't
                                // try 
                                $hpgl[$i][1][$ii] = 
                                        round($factor * $hpgl[$i][1][$ii]);
                        }        
                }
                
        }
        return $hpgl;

}

// Converts a HPGL array back to plain text format
function plain_hpgl($input){
        
        global $HPGL_COMMAND_SPLIT;
        global $HPGL_PARAM_SPLIT; 
        
        $raw_output = "";

        foreach ($input as $cmd) {
                $raw_output .= $cmd[0];
                $i = 1;
                foreach ($cmd[1] as $param) {
                        if($i != count($cmd[1])){
                                $raw_output .= $param.$HPGL_PARAM_SPLIT;
                                $i++;
                        }else{
                                $raw_output .= $param;
                        }

                }
                $raw_output .= $HPGL_COMMAND_SPLIT;
        }

        return $raw_output;
}
