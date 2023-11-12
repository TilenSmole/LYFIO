<?php
        function calculate(){
            include("databasa.php");
            
            $id= $_SESSION["userID"];
            $sql = "SELECT VSOTA FROM data where uid = $id ";
            $result = mysqli_query($conn, $sql); 
            $stanje= 0;
            $max = 0;
            $min = 0;
            $st = 0;
            $pov1= 0;


            while ($row = mysqli_fetch_assoc($result)) { 
                $pov1 += abs($row["VSOTA"]);
                $stanje += $row["VSOTA"];    
                if($row["VSOTA"] > $max)
                    $max = $row["VSOTA"];
                if($row["VSOTA"] < $min)
                $min = $row["VSOTA"];
                $st++;
                }

            $avg = 0;   
            if($st != 0)
                $avg = $pov1 / $st;

                $_SESSION["max"] = $max;
            $_SESSION["min"] = $min;
            $_SESSION["avg"] = $avg;
            $_SESSION["stanje"] = $stanje;
        
        // echo "<script>  window.location='index.php'; </script>";
        mysqli_close($conn);

        }

        
    
    
        


    ?>