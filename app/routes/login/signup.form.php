<div class="">
  <div class="row justify-content-center">
  <div class="col-md-6">
              <h1 class="mb-4">Registration process!</h1>
                <br>
                <p>We're happy to have you join our community.</p>
                <p>Our registration process is free and doesn't require an email address. Just choose a username and password to access all our platform features.</p>
            
                <p>By registering on our website, you can add your name and public key according to the NIP-05 standard on the $mysite domain. You can then manage and edit your entries, as well as view statistics related to them.</p>
                <p>Please note that registration is optinal to add and manage entries, but viewing the entries is open to all. You can visit <a href="https://nips.be/5">nips.be/5</a> to know more.</p>
 

                <p>Please remember to use our system responsibly and avoid any fraudulent activities. We have measures in place to detect and prevent such behavior, and any users found engaging in it will be banned.</p>
                <p>We strive to create a safe and friendly environment for all our users, and we appreciate your help in achieving that goal. Thank you for choosing to be a part of our community, and we hope you have a great experience using our platform.</p>
    

            </div>  




  <div class="col-md-6 p-5">
      <p><b>Please fill in all the fields:</b></p>
      <form method="post" action="/signup/">
        <div class="mb-3">
          <label for="username" class="form-label">Username</label>
          <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="mb-5">
          <label for="confirm_password" class="form-label">Confirm Password</label>
          <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
        </div>
        <hr>
        <div class="mb-2 text-left">
            <img src="/app/captcha/image.php">  
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" name="captcha" placeholder="captcha" required>
            <label for="captcha">captcha</label>
        </div>
        
        <button type="submit" class="btn btn-primary">Register</button>
        <br>
        <p class="mt-4">
          <a href="/terms-of-use/">Terms of use</a>
        </p>
        
      </form>
    </div>
  </div>
</div>
