<?php require "../includes/header.php"; ?>
<?php require "../config/config.php"; ?>

<?php

    if(!isset($_SESSION['user_id'])) {
        header("location: ".APPURL."");
    }

    $bookings = $conn->query("SELECT * FROM bookings WHERE user_id='$_SESSION[user_id]'");
    $bookings->execute();

    $allBookings = $bookings->fetchAll(PDO::FETCH_OBJ);



?>




    <section class="home-slider owl-carousel">

      <div class="slider-item" style="background-image: url(<?php echo APPURL; ?>/images/bg_3.jpg);" data-stellar-background-ratio="0.5">
      	<div class="overlay"></div>
        <div class="container">
          <div class="row slider-text justify-content-center align-items-center">

            <div class="col-md-7 col-sm-12 text-center ftco-animate">
            	<h1 class="mb-3 mt-5 bread">Your Bookings</h1>
	            <p class="breadcrumbs"><span class="mr-2"><a href="<?php echo APPURL; ?>">Home</a></span> <span>Your Bookings</span></p>
            </div>

          </div>
        </div>
      </div>
    </section>

    <section class="ftco-section ftco-cart py-3">
			<div class="container">
				<div class="row">
				<div class="col-md-12 ftco-animate">
					<div class="cart-list">
						<?php if(count($allBookings) > 0) :?>
							<table class="table">
								<thead class="thead-primary">
									<tr class="text-center">
										<th>First Name</th>
										<th>Last Name</th>
										<th>Date</th>
										<th>Time</th>
										<th>Phone</th>
										<th>Message</th>
                                        <th>Status</th>
                                        <th>Write Review</th>
									</tr>
								</thead>
								<tbody>
                                <?php foreach($allBookings as $booking) : ?>
                                    <tr class="text-center">
                                        <td class="align-middle"><?php echo $booking->first_name; ?></td>
                                        <td class="align-middle"><?php echo $booking->last_name; ?></td>
                                        <td class="align-middle">
                                            <h5 class="font-weight-bold"><?php echo $booking->date; ?></h5>
                                        </td>
                                        <td class="align-middle"><?php echo $booking->time; ?></td>
                                        <td class="align-middle"><?php echo $booking->phone; ?></td>
                                        <td class="align-middle"><?php echo $booking->message; ?></td>
                                        <td class="align-middle">
                                        <span class="badge 
                                            <?php 
                                                echo ($booking->status == 'Done') ? 'badge-success' : 
                                                    ($booking->status == 'Pending' ? 'badge-warning' : 
                                                    ($booking->status == 'Confirmed' ? 'badge-primary' : 'badge-danger')); 
                                            ?>">
                                            <?php echo $booking->status; ?>
                                        </span>
                                        </td>

                                        <?php if($booking->status == "Done") : ?>
                                            <td class="align-middle">
                                                <!-- "Write a Review" button with rounded corners -->
                                                <a href="<?php echo APPURL; ?>/reviews/write-review.php" class="btn btn-primary btn-sm rounded" data-toggle="tooltip" data-placement="top" title="Write a review for this order!">
                                                    Write Review
                                                </a>
                                            </td>
                                        <?php endif; ?>

                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
							</table>
						<?php else : ?>
							<div class="text-center py-5">
                            <h4 class="display-4 text-muted">No Table Booked Yet</h4>
                            <p class="lead">It looks like you haven't booked a table yet. Browse our available seating options and reserve a spot for your next visit!</p>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>

    		
			</div>
		</section>


<?php require "../includes/footer.php"; ?>