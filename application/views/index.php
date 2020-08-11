<link rel="stylesheet" type="text/css" 
      href="<?php echo base_url(); ?>/assets/css/style.css">   


<h1 align="center">Email Breached API</h1>
<br>
<p align="center">Enter your email here to check if your Password appear in any data breach</p>
<div style="display: flex; justify-content: center;">
<br />
    <?php echo form_open('mainController/check'); ?>
  Email
  <input type="text" name="Email" id="Email" width=20>
  <br><br>
  <input type="submit" value="Check" class="submit"><br>

</form>
</div>
<br>
<p align="center">See all previous emaill breached</p>
<div style="display: flex; justify-content: center;">
<br/>

 <a href="<?php echo site_url('mainController/previousEmail');?>" ><button class='previousEmaill'>Previous email</button></a>

</div>
</body>
</html>
