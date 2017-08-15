<!--Pulling Awesome Font -->
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
<body>
   <!--  <div class="notice">
        <a href="" class="close">close</a>
        <p class="warn">Whoops! We didn't recognise your username or password. Please try again.</p>
    </div>
 -->


    <!-- Primary Page Layout -->

    <div class="container">
        
        <div class="form-bg">
             <form role="form" action="<?php echo site_url('AdminController/generateReport'); ?>" method="post">
                <h2>Login</h2>
                <p><input type="text" name = "username" placeholder="Username"></p>
                <p><input type="password" name="password" placeholder="Password"></p>
                <!-- <label for="remember">
                  <input type="checkbox" id="remember" value="remember" />
                  <span>Remember me on this computer</span>
                </label> -->
                <button type="submit"></button>
            <form>
        </div>

        <!-- <p class="forgot">Forgot your password? <a href="">Click here to reset it.</a></p> -->

    </div><!-- container -->
