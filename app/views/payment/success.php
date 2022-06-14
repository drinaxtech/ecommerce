    <div class="w-100 h-100">
		<div class="w-100 h-100">
			<div id="row1" class="d-flex justify-content-center align-items-end h-50 pb-3">
				<div class="w-100 pl-2 pr-2">
					<div style="margin:0 auto;" class="d-table text-center">
                        <div class="w-100 d-flex justify-content-center">
						    <div class="circular bg-success d-flex justify-content-center align-items-center">
							    <i class="fa fa-check fa_icon"></i>
						    </div>
						</div>
						<div class="title success">SUCCESS</div>
				        <div class="text-center text-dark">Your payment has been authorized</div>
						
						<div class="text-center text-dark">Your order is processed</div>
                        <div class="text-center text-dark">Amount: <span class="font-weight-bold">$<?php echo number_format($totalAmount, 2); ?></span></div>
			        </div>
		        </div>
			</div>
			<div class="d-flex justify-content-center align-items-start h-50 pt-3 pb-5">
				<div class="content w-100 h-100">


					<div style="margin:0 auto;width: 260px;" class="d-table text-center">
					    <button type="button" class="btn btn-outline-orange">Thank you, mail is send to the given mail address please check your SPAM box</button>
			        </div>

                   
					<div class="mt-4" style="text-align:center">
							INVITE YOUR FRIENDS TO BUY A PRODUCT
                    </div>

					<div class="text-center mt-3 mb-2">
						<a class="mr-3 socialShareLinks" href="https://wa.me/?text=Here is the link: <?php echo BASE_URL; ?>" data-action="share/whatsapp/share" onClick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank" title="Invite on whatsapp">
                            <i class="fa fa-whatsapp text-dark" style="font-size:30px"></i>
                        </a>

                        <a class="mr-3 socialShareLinks" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo BASE_URL; ?>&t= Here is the link:  <?php echo BASE_URL; ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank" title="Invite on Facebook">
                            <i class="fa fa-facebook text-dark" style="font-size:26px"></i>
                        </a>

                        <a class="mr-3 socialShareLinks" href="https://twitter.com/share?url=<?php echo BASE_URL; ?>&text=" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank" title="Invite on Twitter">
                            <i class="fa fa-twitter text-dark" style="font-size:29px"></i>
                        </a>

                        <a class="mr-3 socialShareLinks" href="mailto:?subject=buy the products from here&body=Here is the link: <?php echo BASE_URL; ?>" onClick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank" title="Invite with Mail">
                            <i class="fa fa-envelope text-dark" style="font-size:28px"></i>
                        </a>
                    </div>

                    <div  class="mt-4" style="margin:0 auto;width: 200px;" class="d-table text-center">
					    <a href="<?php echo BASE_URL; ?>" class="btn btn-dark">Order Again</a>
			        </div>

				
		        </div>


				
			</div>
		</div>
	</div>