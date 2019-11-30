<!--Enquiry modal -->
<div id="updateordinance" class="modal fade in col-md-10" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
	  <div class="modal-content" style="height:auto">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Request Purchase</h4>
              </div>
              <div class="modal-body">
			  <form class="form-horizontal" method="post" action="../purchase_add.php" enctype='multipart/form-data'>
				<input type="text" id="enqid" name="enqid" />
				 <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>             
                        <th>Part Code</th>
                        <th>Name</th>
						<th>Category</th>
						<th>Supplier</th>
						<th>Order Type</th>
						<th>Quantity</th>
            			<th>Enquiry Date</th>
                      </tr>
                    </thead>
                    <tbody id="enqlist" name="enqlist">
					
					</tbody>
				</table>
              </div>
              <div class="modal-footer">
				<button type="submit" class="btn btn-primary">Purchase Request</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
			  </form>
            </div>
			
        </div><!--end of modal-dialog-->
 </div>
 <!--end of modal--> 