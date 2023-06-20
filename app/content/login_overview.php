       <!-- Page Content-->
       <div class="container w-100">
            <!-- Heading Row-->
             
            <div class="row gx-4 gx-lg-5 align-items-center my-5">
                <div class="col-lg-5"><img class="img-fluid rounded mb-4 mb-lg-0" src="/images/businesstag.jpg" alt="..." width=300 /></div>
                <div class="col-lg-6">
                    <h1 class="font-weight-light">About us</h1>
                    <p><?php echo $defcontent["businesstag"]; ?></p>
                  </div>
            </div> 
            <!-- Call to Action-->
<?php
    if (isset($warningmessage)){
?>

            <div class="card text-white bg-warning my-5 py-4 text-center">
                
                <div class="card-body"><p class="text-white m-0">This call to action card is a great place to showcase some important information or display a clever tagline!</p></div>
            </div>
<?php
}else{
?>
            <div class=" text-white my-2 py-0 text-center">
                
                <div class="card-body"><p class="text-white m-0">This call to action card is a great place to showcase some important information or display a clever tagline!</p></div>
            </div>
<?php
}

?>
            <!-- Content Row-->
            <div class="row gx-4 gx-lg-5 w-100">
                <div class="col-md-4 mb-5 col-12 col-sm-12 col-xl-4">
                    <div class="shadow-sm card ">
                        <div class="card-body">
                            <p class="card-text">
                                <?php include("../content/login_loginform.php"); ?>
                                
                            </p>
                        </div>
                        <div class="card-footer"><i class="fa fa-right-to-bracket"></i> &nbsp; &nbsp; &nbsp; Login </div>
                    </div>
                </div>
                <div class="col-md-4 mb-5">
                    <!-- h-100 -->
                    <div class="card  shadow-sm">
                        <div class="card-body">
                            
                            <p class="card-text">
                                <?php include("../content/login_registerform.php"); ?>
                            </p>
                        </div>
                        <div class="card-footer"><i class="fa fa-user-plus"></i> &nbsp; &nbsp; &nbsp; Register Account </div>
                    </div>
                </div>
                <div class="col-md-4 mb-5">
                    <div class="card  shadow-sm">
                    <div class="card-body">
                            <p class="card-text">
                                <?php include("../content/login_resetpwform.php"); ?>
                            </p>
                    </div>
                    <div class="card-footer"><i class="fa fa-unlock"></i> &nbsp; &nbsp; &nbsp; forgot password </div>
                </div>
            </div>

            <div class="row gx-4 gx-lg-5 my-5 w-100">
                <div class="col-lg-5"><img class="img-fluid rounded mb-4 mb-lg-0" src="/images/businesstag.jpg" alt="..." width="400"/></div>
                <div class="col-lg-6">
                <div class="col-md-200 mb-100">
                    <div class="shadow-sm card h-500">
                        <div class="card-body  h-500 gx-lg-10">
                            <p class="card-text h-500">
                                
                                
                            </p>
                        </div>
                        <div class="card-footer"><i class="fa fa-right-to-bracket"></i> &nbsp; &nbsp; &nbsp; Login </div>
                    </div>
                </div>
                  </div>
            </div> 

<p/>
        </div>