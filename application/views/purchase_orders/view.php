<div class="container">
	<div class="row margin-top-20">
		<div class="col-md-8 col-md-offset-2">
			
			<h4 class="text-center text-bold text-16 margin-top-20"><u>Purchase Order</u></h4>
			
			<div class="row margin-top-20">
				<div class="col-lg-6">
					<table class="table border-top-0 text-12 padding-5">
						<tbody>
							<tr>
								<td class="col-lg-3 text-bold">Supplier :</td>
								<td class="col-lg-10"><?php echo ucwords($row->supplier_name); ?></td>
							</tr>
							<tr>
								<td class="col-lg-2 text-bold">Address :</td>
								<td class="col-lg-10"><?php echo ucwords($row->supplier_address); ?></td>
							</tr>
							<tr>
								<td colspan="2">&nbsp;</td>
							</tr>
							<tr>
								<td class="col-lg-2 text-bold">Attention :</td>
								<td class="col-lg-10"><?php echo ucwords($row->attention); ?></td>
							</tr>
						</tbody>
					</table>
									
				</div>
				<div class="col-lg-6">
					<table class="table border-top-0 text-12 margin-left-30">
						<tbody>
							<tr>
								<td class="text-right text-bold">Date :</td>
								<td><?php echo $row->date; ?></td>
							</tr>
							<tr>
								<td class="text-right text-bold">PO Number :</td>
								<td><u><?php echo $row->transNum; ?></u></td>
							</tr>
							<tr>
								<td class="text-right text-bold">You Ref. No :</td>
								<td><?php echo $row->refNo; ?></td>
							</tr>
							<tr>
								<td class="text-right text-bold">Delivery :</td>
								<td><?php echo $row->delivery_name; ?></td>
							</tr>
							<tr>
								<td class="text-right text-bold">Terms :</td>
								<td><?php echo $row->term_name; ?></td>
							</tr>
						</tbody>
					</table>
									
				</div>
			</div>
		
			<!-- list of items -->
			
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
					$min_rows = 7; 
					$grand_total = 0; // gross total amount
				?>
				<?php if( $orderline->exists() ) : ?>
				<?php foreach( $orderline as $o ) : ?>
				<?php
					$line_total = $o->qty * $o->unitPrice;
					$grand_total += $line_total;
				?>
					<tr>
						<td class="text-center"><?php echo $o->itemNo; ?></td>
						<td class="text-center"><?php echo $o->qty; ?></td>
						<td class="text-center"><?php echo $o->unit; ?></td>
						<td class=""><?php echo $o->descript; ?></td>
						<td class="text-right">P <?php echo $o->unitPrice; ?></td>
						<td class="text-right text-bold">P <?php echo number_format( $line_total, 2); ?></td>
					</tr>
				<?php $min_rows--; ?>
				<?php endforeach; ?>
				<?php endif; ?>
				<?php for( $x = 1; $x <= $min_rows; $x++ ) : ?>
					<tr>
						<td colspan="6">&nbsp;</td>
					</tr>
				<?php endfor; ?>
				</tbody>
				<tfoot style="border-top:1px solid gray">
					<tr>
						<td colspan="5" class="text-right text-bold">
							Total Price ( 12 % VAT Inclusive)
						</td>
						<td class="text-right text-bold">
							P <?php echo number_format( $grand_total, 2); ?>
						</td>
					</tr>
				</tfoot>
			</table>
			
			
			
			<div class="row margin-top-30">
				<div class="col-lg-3">
					<p class="text-12 signature">Prepared By: </p>
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
			</p>
		</div>
	</div>
	
</div>