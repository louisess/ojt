<?php
                              echo "<select>";
                              for ($eventdate = 1; $eventdate <= 31; $eventdate++) {
                                if($eventdate = 1 || 21 || 31){
                                  echo "<option value=$eventdate".'st'.">$eventdate".'st'."<br></option>";
                                }else if($eventdate = 2 || 22){
                                  echo "<option value=$eventdate".'nd'.">$eventdate".'nd'."<br></option>";
                                }else if($eventdate = 3 || 23){
                                  echo "<option value=$eventdate".'rd'.">$eventdate".'rd'."<br></option>";
                                }else{
                                  echo "<option value=$eventdate".'th'.">$eventdate".'th'."<br></option>";
                                }
                              }
                              echo "</select>";
                            ?>