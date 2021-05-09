                 <div id="certlist" style="display: block;" class="answer_list" >
                  <h5>MY CERTIFICATES</h5>
                  <p>
                    <i class="fas fa-asterisk"></i> A list of your saved certificates for events.
                  </p>

                  <hr>

                   
                        <?php
                            $id =  $_SESSION['user'];
                            //$sql2 = "SELECT * FROM certificates WHERE orgid = '".$_SESSION['user']."'";
                            $certrow = $funObj->viewCerts($id);

                            if(!$certrow){
                              echo "<label> There are no certificates here... </label>";
                            }else{
                              while ($certrow = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                extract($certrow);
                                echo ' <div id="accordion">
                                        <table class="table table-hover text-custom">
                                        <thead class="text-custom">
                                        <tr>
                                          <th scope="col">EVENT NAME</th>
                                          <th scope="col">DATE</th>
                                          <th scope="col">VENUE</th>
                                          <th scope="col"></th>
                                        </tr>
                                      </thead>
                                      <tbody>';
                                echo ' <tr data-toggle="collapse" data-target="#collapse1" class="clickable hover collapse-row collapsed accordion-toggle" title="ℹ Click row for details">
                          
                                <td>'.$certrow['eventname'].'</td>';
                                echo '<td>'.$certrow['eventdate'].'</td>';
                                echo '<td>'.$certrow['venue']. '<td>';
                                echo '                          <td colspan="2">
                            <a href="../ojt/participantsform.html" type="button" class="btn btn-success btn-sm">GENERATE PARTICIPANT FROM</a>
                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#exampleModal">GENERATE CERTIFICATES</button>
                            
                          </td>
                        </tr>
                        <div id="collapse1" class="accordion-body collapse in">
                        <tr>
                          <!----------WHERE DETAILS APPEAR------------->
                            <td colspan="4">
                              <table class="table table-borderless">
                                <tbody>
                                  <tr>
                                    <th scope="col">EVENT</th>
                                    <td>Castle Black Seminar</td>
                                  </tr>

                                  <tr>
                                    <th scope="row">DATE</th>
                                    <td>04/11/2020</td>
                                  </tr>

                                  <tr>
                                    <th scope="row">HOST</th>
                                    <td>Jon Snow</td>
                                  </tr>

                                  <tr>
                                    <th scope="row">VENUE</th>
                                    <td>The Wall</td>
                                  </tr>

                                </tbody>
                              </table>
                                
                            </td>
                            <!----------END OF DETAILS------------->
                        </tr>

                        </div>
                         </tbody>
                    </table>
                    </div>';
                              }
                            }
                          ?>


                   

                 </div>