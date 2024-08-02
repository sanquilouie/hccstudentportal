<div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-body" style="height:450px;">
        <form action="" method="POST" >
            <div id="carouselExampleControls" class="carousel slide carousel-dark slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <?php
                        $sql = "SELECT * FROM activities WHERE statusis = 'Active'";
                        $result1 = mysqli_query($conn, $sql);

                        if ($result1->num_rows > 0) {
                            while ($row1 = mysqli_fetch_array($result1)) {
                                echo 
                                '<div class="carousel-item" style="height:450px;">
                                <div class="row" style="background:blue;">
                                <div class="col">
                                <div class="col font-monospace position-absolute top-0 start-50 translate-middle pt-5">
                                        <label class="fs-3 fw-bold">'.$row1['title'].'</label>
                                    </div>
                                </div>

                                </div>
                                    
                                    <div class="col p-5 mt-5">
                                        <label class="fs-5 fw-bold">'.$row1['caption'].'</label>
                                    </div>
                                </div>';
                            }
                        }else{
                            echo '<script>console.log("Your stuff here")</script>';
                        }
                    ?>
                    
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </form>
      </div>    
    </div>
  </div>
</div>  



