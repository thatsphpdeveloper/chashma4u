 <div class="list-group">
   <a href="<?=BASEURL?>/user/profile" class="list-group-item <?=($this->subMenu == 102) ? 'active' : ''; ?>">Account Details</a>
   <a href="<?=BASEURL?>/user/change-password" class="list-group-item <?=($this->subMenu == 105) ? 'active' : ''; ?>">Change password</a>
   <a href="<?=BASEURL?>/user/address" class="list-group-item <?=($this->subMenu == 103) ? 'active' : ''; ?>">My Addresses</a> 
   <a href="<?=BASEURL?>/wishlist" class="list-group-item <?=($this->subMenu == 101) ? 'active' : ''; ?>">My Wishlist</a>
   <a href="<?=BASEURL?>/user/order" class="list-group-item <?=($this->subMenu == 104) ? 'active' : ''; ?>">My Order History</a> 
   <a href="<?=BASEURL?>/home/logout" class="list-group-item <?=($this->subMenu == 106) ? 'active' : ''; ?>">Logout</a> 
</div>