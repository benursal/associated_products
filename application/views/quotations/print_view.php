<div class="container">
	<div class="row margin-top-20">
		<div class="col-md-8 col-md-offset-2">
			<img src="<?php echo site_url('assets/images/letterhead.gif'); ?>" />
			
			<div class="row margin-top-20">
				<div class="col-lg-6">
					<table class="table border-top-0 text-12 padding-5">
						<tbody>
							<tr>
								<td class="col-lg-3 text-bold">Customer :</td>
								<td class="col-lg-10"><?php echo ucwords($row->customer_name); ?></td>
							</tr>
							<tr>
								<td class="col-lg-2 text-bold">Address :</td>
								<td class="col-lg-10"><?php echo ucwords($row->customer_address); ?></td>
							</tr>
							<tr>
								<td class="col-lg-2 text-bold">Attention :</td>
								<td class="col-lg-10"><?php echo ucwords($row->attention); ?></td>
							</tr>
							<tr>
								<td class="col-lg-2 text-bold">Subject :</td>
								<td class="col-lg-10"><?php echo $row->subject; ?></td>
							</tr>
						</tbody>
					</table>
									
				</div>
				<div class="col-lg-6">
					<table class="table border-top-0 text-12" style="margin-left:60px;">
						<tbody>
							<tr>
								<td class="text-right text-bold">Date :</td>
								<td><?php echo $row->date; ?></td>
							</tr>
							<tr>
								<td class="text-right text-bold">Quotation # :</td>
								<td><u><?php echo $row->transNum; ?></u></td>
							</tr>
							<tr>
								<td class="text-right text-bold">Reference # :</td>
								<td><?php echo $row->subject; ?></td>
							</tr>
							<tr>
								<td class="text-right text-bold">Total Amount :</td>
								<td><u id="theGrandTotal"></u></td>
							</tr>
						</tbody>
					</table>
									
				</div>
			</div>
			
			<h4 class="text-center text-bold text-16 margin-top-0"><u>Quotation</u></h4>
			<!-- list of items -->
			<p class="text-12  margin-top-20">
				Dear Sir :<br /><br />

				We have the pleasure of submitting our offer to your requirements : 
			</p>
			<table class="table text-12 margin-top-10 printable">
				<thead>
					<tr>
						<th class="text-center col-item-no">No.</th>
						<th class="text-center col-qty">QTY</th>
						<th class="text-center col-unit">Unit</th>
						<th class="col-description">Description</th>
						<th class="text-right col-unit-price">Unit Price</th>
						<th class="text-right col-amount">Amount</th>
					</tr>
				</thead>
				<tbody>
				<?php 
					$default_lines = 20; // based on number of BRs
					$total_lines = 0;
					
					$min_rows = 7; 
					$grand_total = 0; // gross total amount
				?>
				<?php if( $orderline->exists() ) : ?>
				<?php foreach( $orderline as $o ) : ?>
				<?php
					// description
					
					//$d = explode('<br />', str_replace('<br>', '<br />', $o->descript));
					
					$line_total = $o->qty * $o->unitPrice;
					$grand_total += $line_total;
				?>
					<tr>
						<td class="text-center"><?php echo $o->itemNo; ?></td>
						<td class="text-center"><?php echo $o->qty; ?></td>
						<td class="text-center"><?php echo $o->unit; ?></td>
						<td class=""><?php echo $o->descript; ?></td>
						<td class="text-right">P <?php echo number_format($o->unitPrice, 2); ?></td>
						<td class="text-right text-bold">P <?php echo number_format( $line_total, 2); ?></td>
					</tr>
				<?php $min_rows--; ?>
				<?php endforeach; ?>
				<?php endif; ?>
				
				</tbody>
			</table>
			
			<div class="row">
				<div class="col-lg-6 col-lg-offset-6 text-right">
					<?php if( $row->vat > 0 || $row->rate > 0 ) : ?>
					<div class="row">
						<div class="col-lg-4 col-lg-offset-4 text-12">Gross Price</div>
						<div class="col-lg-4 text-12 text-right">P <?php echo number_format( $grand_total, 2 ); ?></div>
					</div>
					<?php endif; ?>
					
					<?php if( $row->vat > 0 ) : // if there is a VAT included ?>
					<?php
						$vat = ( $row->vat/100 ) * $grand_total;
						// update gross
						$grand_total += $vat;
					?>
					<div class="row">
						<div class="col-lg-4 col-lg-offset-4 text-12"><?php echo $row->vat; ?>% VAT</div>
						<div class="col-lg-4 text-12 text-right"><?php echo number_format( $vat, 2 ); ?></div>
					</div>
					<div class="row">
						<div class="col-lg-4 col-lg-offset-4 text-12">&nbsp;</div>
						<div class="col-lg-4 text-12 text-right"><?php echo number_format( $grand_total, 2 ); ?></div>
					</div>
					<?php endif; ?>
					
					
					<?php if( $row->rate > 0 ) : // if there is a discount ?>
					<?php
						$discount = ($row->rate / 100) * $grand_total;
						$grand_total -= $discount;
					?>
					<div class="row">
						<div class="col-lg-4 col-lg-offset-4 text-12">less <?php echo $row->rate; ?>% disc</div>
						<div class="col-lg-4 text-12 text-right"><?php echo number_format( $discount, 2 ); ?></div>
					</div>
					<?php endif; ?>
					
					<div class="row">
						<div class="col-lg-12 text-12 text-right text-bold">
							Net Price (12% VAT <?php echo ucwords($row->inclusion); ?>)  
							<u class="margin-left-10">PHP <?php echo number_format( $grand_total, 2); ?></u>
						</div>
					</div>
				</div>
			</div>
			
			<div class="row margin-top-10">
				<div class="col-lg-1 text-12 text-bold">Delivery:</div>
				<div class="col-lg-6 text-12"><?php echo ucwords($row->delivery_name); ?></div>
			</div>
			<div class="row margin-top-5">
				<div class="col-lg-1 text-12 text-bold">Terms:</div>
				<div class="col-lg-6 text-12"><?php echo ucwords($row->term_name); ?></div>
			</div>
			<div class="row margin-top-5">
				<div class="col-lg-1 text-12 text-bold">Validity:</div>
				<div class="col-lg-6 text-12"><?php echo ucwords($row->validity_name); ?></div>
			</div>
			
			<div class="row margin-top-20">
				<div class="col-lg-12">
					<p class="text-12">
						We trust that you will find our offer of interest and in the event that you should require any furthuer details or additional information, please do not hesitate to contact us, as we remain at your complete disposal. 
					</p>
				</div>
			</div>
			
			<div class="row margin-top-20">
				<div class="col-lg-3">
					<p class="text-12 signature">Very truly yours, </p>
					<span class="text-12"><?php echo $row->prepared; ?></span>
				</div>
				<div class="col-lg-3 col-lg-offset-2">
					<p class="text-12 signature">Noted By: </p>
					<span class="text-12">Alexander P. Porras<br />General Manager</span>
				</div>
			</div>
			<p class="margin-top-40 text-center hidden-in-print">
				<button type="button" class="btn btn-primary" onclick="print();">
					Print Now
				</button> 
				<!--<button type="button" class="btn btn-success" onclick="get_height();">
					Get height of table
				</button>-->
			</p>
			
			
			
		</div>
	</div>
	
</div>
<script>
var grand_total = '<?php echo number_format( $grand_total, 2); ?>';
document.getElementById('theGrandTotal').innerHTML = 'PHP ' + grand_total;
var min_height = 320;
</script>