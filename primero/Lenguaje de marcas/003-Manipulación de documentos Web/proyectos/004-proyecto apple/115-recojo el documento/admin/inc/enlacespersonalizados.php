<?php 
                if(isset($_GET['enlace'])) 
                    echo '<iframe src="'.htmlspecialchars($_GET['enlace']).'" 
                          style="width:100%; height:100%; border:none;"></iframe>';
                
                ?>